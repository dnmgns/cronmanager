#cronmanager
=======

###NAME
cronmanager.php


###SYNOPSIS
cronmanager.php [ARGUMENT]

###INSTALLATION
Rename _setting.php to settings.php and edit that file.

Run cronmanager.php -i as the user you wish to install the crontab for.

###SETTINGS
######specificUsersOnly
Only specific users can run cronmanager.

value: true/false

######allowedUsers
A list of users allowed to run cronmanager.

note: only in use if specificUsersOnly is set to true

value: any usernames

######jobs
A list of jobs to be added to cron

value: cron scheduling definitions

###DESCRIPTION
A crontab manager written in PHP

######Available arguments
#####-l, --list
list current jobs from crontab
#####-i, --install
install new jobs from settings to crontab
#####-r, --replace
remove all installed jobs from crontab, replace with new jobs from settings

