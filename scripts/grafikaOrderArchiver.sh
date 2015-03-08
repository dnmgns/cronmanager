#!/bin/sh
# Author: Magnus Janson
# Date:   2014-01-30 00:36:01
# Last Modified time: 2014-03-06 07:12:21

# Settings
internaldelivery="/home/grafika/delivery/"
printasdelivery="/home/grafika/printas/"
printasdeliveryname="$(date +'%A')"_"$(date +%Y_%m_%d)"
archive="/home/grafika/archive/"

# Archive already printed folders
rsync -a --remove-source-files $printasdelivery $archive

# Delete empty folders from printas folders
find $printasdelivery -depth -type d -empty -delete

# Create current date folder in printas
mkdir -p $printasdelivery$printasdeliveryname

# Perform new delivery to printas
mv $internaldelivery* $printasdelivery$printasdeliveryname

# Set correct rights for date folder in printas
chmod -R 775 $printasdelivery$printasdeliveryname
