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
- `moodle/mod/quiz:viewoverrides`


Requirements
------------
- Moodle 4.0 (build 2022041900.00 or later)

Installation
------------
Copy the remote_courses folder into your /local directory and visit your Admin Notification page to complete the installation.

Author
------
Dominque Palumbo (2023 UCLOUVAIN)