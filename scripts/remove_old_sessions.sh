#!/bin/sh
find /var/lib/php5/ -name 'sess_*' -type f -mtime +2 -exec rm {} \;