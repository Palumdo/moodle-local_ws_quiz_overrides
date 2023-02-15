<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * External functions for managing quiz overrides.
 *
 * @package    local_ws_quiz_overrides
 * @copyright  2023 UCLOUVAIN
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
opcache_invalidate(__FILE__, true);
defined('MOODLE_INTERNAL') || die;

require_once($CFG->dirroot . '/lib/externallib.php');
/**
 * Create a quiz overrides based on quizid and user id.
 *
 * @package    local_ws_quiz_overrides
 * @copyright  2023 UCLOUVAIN
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class local_ws_quiz_overrides_external extends external_api {
    /**
     * Returns description of method parameters
     *
     * @return external_function_parameters
     */
    public static function create_quiz_overrides_parameters() {
        return new external_function_parameters(
                array(
                    'userid' => new external_value(PARAM_INT, 'userid'),
                    'quizid' => new external_value(PARAM_INT, 'quizid'),
                    'multiplier' => new external_value(PARAM_FLOAT, 'multiplier'),
                )
        );
    }

    /**
     * Create or update a quiz overrides
     *
     * This allow to create or update a quiz overrides with a web service
     *
     * @param int $userid
     * @param int $quizid
     * @param float $multiplier
     * @return int
     */
    public static function create_quiz_overrides($userid, $quizid, $multiplier) {
        global $DB;
        $result = -1;

        // Validate parameters passed from webservice.
        $params = self::validate_parameters(self::create_quiz_overrides_parameters(), array('userid' => $userid, 'quizid' => $quizid, 'multiplier' => $multiplier));
        $timelimit = $DB->get_record_sql("SELECT timelimit FROM {quiz} WHERE id = :param1", array('param1' =>$quizid));
        if ($timelimit->timelimit > 0) {
            $override = $DB->count_records_sql("SELECT count(id) FROM {quiz_overrides} WHERE userid=:param1 AND quiz=:param2", array('param1' => $userid, 'param2' =>$quizid));
            $dataobject = new stdClass();
            $dataobject->quiz = $quizid;
            $dataobject->userid = $userid;
            $dataobject->timelimit = $timelimit->timelimit * $multiplier;
            if ($override == 0) {
              $result = $DB->insert_record('quiz_overrides', $dataobject);
            } else {
              $overid = $DB->get_record_sql("SELECT id FROM {quiz_overrides} WHERE userid=:param1 AND quiz=:param2", array('param1' => $userid, 'param2' =>$quizid));
              $dataobject->id = $overid->id;
              $result = $dataobject->id;
              $DB->update_record('quiz_overrides', $dataobject);
            }
        }
        return $result;
    }

    /**
     * Returns description of create_quiz_overrides_returns() result value.
     *
     * @return \core_external\external_description
     */
    public static function create_quiz_overrides_returns() {
        return new external_value(
            PARAM_INT,
            'The id of the newly created record => OK, -1 => FAILED'
        );
    }
    
    /**
     * Returns description of method parameters
     *
     * @return external_function_parameters
     */
    public static function delete_quiz_overrides_parameters() {
        return new external_function_parameters(
                array(
                    'userid' => new external_value(PARAM_INT, 'userid'),
                    'quizid' => new external_value(PARAM_INT, 'quizid'),
                )
        );
    }

    /**
     * Delete a quiz overrides
     *
     * This allow to delete a quiz overrides with a web service
     *
     * @param int $userid
     * @param int $quizid
     * @return bool
     */
    public static function delete_quiz_overrides($userid, $quizid) {
        global $DB;
        $result = false;
        // Validate parameters passed from webservice.
        $params = self::validate_parameters(self::delete_quiz_overrides_parameters(), array('userid' => $userid, 'quizid' => $quizid));
        
        $dataarray = array('quiz' => $quizid, 'userid' => $userid);
        $DB->delete_records('quiz_overrides', $dataarray);
        $result = true;
        return $result;
    }

    /**
     * Returns description of delete_quiz_overrides_returns() result value.
     *
     * @return \core_external\external_description
     */
    public static function delete_quiz_overrides_returns() {
        return new external_value(
            PARAM_BOOL,
            'The deleted record TRUE => OK, FALSE => FAILED'
        );
    }
}
