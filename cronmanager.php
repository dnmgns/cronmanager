#!/usr/bin/php
<?php
/**
* Author: Magnus Janson
* Date:   2014-01-30 00:35:10
* Last Modified time: 2014-01-30 01:08:58
*/

require './lib/CronManager.php';
require './lib/CronSettings.php';
require 'settings.php';

use Crontab\CronManager;
use Crontab\CronSettings;

$cronSettings = new cronSettings($settings);
$specificUsersOnly = $cronSettings->getspecificUsersOnly();
$allowedUsers = $cronSettings->getAllowedUsers();
$jobs = $cronSettings->getJobs();

if($specificUsersOnly && !in_array(exec('whoami'), $allowedUsers)) {
 die('You are not allowed to run the script as this user'.PHP_EOL);
}

$argument = isset( $argv[1] )  ? strtolower($argv[1]) : null;
$available_arguments = array(
    '--list',
    '-l',
    '--install',
    '-i',
    '--replace',
    '-r',
);


if(!in_array($argument, $available_arguments)) {
    print('Usage: cronmanager.php [ARGUMENT]'.PHP_EOL);
    print(PHP_EOL);
    print('Available arguments:'.PHP_EOL);
    print('  -l, --list'.PHP_EOL);
    print('     list current jobs from crontab'.PHP_EOL);
    print('  -i, --install'.PHP_EOL);
    print('     install new jobs from settings to crontab'.PHP_EOL);
    print('  -r, --replace'.PHP_EOL);
    print('     remove all installed jobs from crontab, replace with new jobs from settings'.PHP_EOL);
}

switch($argument) {
    case '--list':
    case '-l':
    print('Here\'s a list of all jobs. Cowboy!'.PHP_EOL);
    $currentJobs = CronManager::getJobs();
    print(CronManager::getJobsString());
    break;

    case '--install':
    case '-i':
    print('Installing new jobs'.PHP_EOL);
    foreach($jobs as $job) {
        CronManager::addJob($job);
    }
    print(CronManager::getJobsString());
    break;

    case '--replace':
    case '-r':
    print('Replacing all current jobs'.PHP_EOL);
    CronManager::saveJobs($jobs);
    print(CronManager::getJobsString());
    break;

    default:
    break;
}
