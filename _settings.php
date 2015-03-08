<?php
/**
* Author: Magnus Janson
* Date:   2014-01-30 00:35:16
* Last Modified time: 2014-01-30 01:12:02
*/

/** Get script dir */
$scriptDir = dirname(__FILE__) . '/scripts/';

/** Map scripts to var */
$grafikaOrderArchiver = $scriptDir . 'grafikaOrderArchiver.sh';
$removeOldSessions = $scriptDir . 'remove_old_sessions.sh';

/** Settings */
$settings = array(

/**
*  Cron scheduling definition
*  * * * * *  command to execute
*  ┬ ┬ ┬ ┬ ┬
*  │ │ │ │ │
*  │ │ │ │ │
*  │ │ │ │ └───── day of week (0 - 7) (0 to 6 are Sunday to Saturday, or use names; 7 is Sunday, the same as 0)
*  │ │ │ └────────── month (1 - 12)
*  │ │ └─────────────── day of month (1 - 31)
*  │ └──────────────────── hour (0 - 23)
*  └───────────────────────── min (0 - 59)
*/
    'crontab' => array(
        'specificUsersOnly' => true,
        'allowedUsers'  => array(
          'www',
        ),
        'jobs' => array(
                '* 5 * * 1 sh ' . $grafikaOrderArchiver,  // Run once a week at 5AM on Monday
                '* 5 * * 4 sh ' . $grafikaOrderArchiver,  // Run once a week at 5AM on Thursday
                '0 0 * * * sh ' . $removeOldSessions,     // Run once every midnight
        ),
    ),
);

return $settings;
