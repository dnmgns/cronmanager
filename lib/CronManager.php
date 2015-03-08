<?php
/**
* Author: Magnus Janson
* Date:   2014-01-30 00:36:01
* Last Modified time: 2014-01-30 00:58:58
*/

namespace Crontab;

class CronManager 
{
    static private function stringToArray($jobs = '') {
        $array = explode("\r\n", trim($jobs));
        foreach ($array as $key => $value) {
            if ($value == '') {
                unset($array[$key]);
            }
        }
        return $array;
    }
    
    static private function arrayToString($jobs = array()) {
        $string = implode("\r\n", $jobs);
        return $string;
    }
    
    static public function getJobs() {
        $output = shell_exec('crontab -l');
        return self::stringToArray($output);
    }

    static public function getJobsString() {
        $output = shell_exec('crontab -l');
        return $output;
    }
    
    static public function saveJobs($jobs = array()) {
        $output = shell_exec('echo "'.self::arrayToString($jobs).'" | crontab -');
        return $output; 
    }
    
    static public function doesJobExist($job = '') {
        $jobs = self::getJobs();
        if (in_array($job, $jobs)) {
            return true;
        } else {
            return false;
        }
    }
    
    static public function addJob($job = '') {
        if (self::doesJobExist($job)) {
            return false;
        } else {
            $jobs = self::getJobs();
            $jobs[] = $job;
            return self::saveJobs($jobs);
        }
    }
    
    static public function removeJob($job = '') {
        if (self::doesJobExist($job)) {
            $jobs = self::getJobs();
            unset($jobs[array_search($job, $jobs)]);
            return self::saveJobs($jobs);
        } else {
            return false;
        }
    }
}
