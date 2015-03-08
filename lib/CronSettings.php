<?php
/**
* Author: Magnus Janson
* Date:   2014-01-30 00:35:01
* Last Modified time: 2014-01-30 00:58:48
*/

namespace Crontab;

class CronSettings
{
    public $specificUsersOnly;
    public $allowedUsers;
    public $jobs;

    public function __construct(array $settings = null)
    {
        if (is_array($settings)) {
            $this->specificUsersOnly = $settings['crontab']['specificUsersOnly'];
            $this->allowedUsers      = $settings['crontab']['allowedUsers'];
            $this->jobs              = $settings['crontab']['jobs'];
        }
    }

    public function getspecificUsersOnly()
    {
        return $this->specificUsersOnly;
    }

    public function getAllowedUsers()
    {
        return $this->allowedUsers;
    }

    public function getJobs()
    {
        return $this->jobs;
    }
}
