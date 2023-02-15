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
// along with Moodle. If not, see <http://www.gnu.org/licenses/>.

/**
 * Custom web services for this plugin.
 *
 * @package    local_ws_quiz_overrides
 * @copyright  2023 UCLOUVAIN
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$functions = array(
    'local_ws_quiz_overrides_create_quiz_overrides' => array(
        'classname'    => 'local_ws_quiz_overrides_external',
        'methodname'   => 'create_quiz_overrides',
        'classpath'    => 'local/ws_quiz_overrides/externallib.php',
        'description'  => 'Create an override for a user in a quiz.',
        'type'         => 'create',
        'capabilities' => 'moodle/mod/quiz:manageoverrides',
    ),
    'local_ws_quiz_overrides_delete_quiz_overrides' => array(
        'classname'    => 'local_ws_quiz_overrides_external',
        'methodname'   => 'delete_quiz_overrides',
        'classpath'    => 'local/ws_quiz_overrides/externallib.php',
        'description'  => 'Delete an override for a user in a quiz.',
        'type'         => 'delete',
        'capabilities' => 'moodle/mod/quiz:manageoverrides',
    ),    
);
