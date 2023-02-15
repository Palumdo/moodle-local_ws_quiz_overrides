Quiz overrides web service
=========================

![Moodle Plugin CI]

This local module provides a web service which 

Configuration
-------------
To use this service you will need to create the following:

1. A web service on a Moodle installation
2. A user with sufficient permissions to use the web service
3. A token for that user

See [Using web services](https://docs.moodle.org/33/en/Using_web_services) in the Moodle documentation for information about creating and enabling web services. The user will need the following capabilities in addition to whichever protocol you enable:

- `moodle/mod/quiz:manageoverrides`

Use
----
Take care that is the quiz id and not the cmid of the activity.
The create service insert or update if the override already exist.

https://myhost/webservice/rest/server.php?moodlewsrestformat=json&&wstoken=mytoken&wsfunction=local_ws_quiz_overrides_create_quiz_overrides&userid=1234&quizid=5678&multiplier=1.5
https://myhost/webservice/rest/server.php?moodlewsrestformat=json&&wstoken=mytoken&wsfunction=local_ws_quiz_overrides_delete_quiz_overrides&userid=1234&quizid=5678

Requirements
------------
- Moodle 4.0 (build 2022041900.00 or later)

Installation
------------
Copy the remote_courses folder into your /local directory and visit your Admin Notification page to complete the installation.

Author
------
Dominque Palumbo (2023 UCLOUVAIN)