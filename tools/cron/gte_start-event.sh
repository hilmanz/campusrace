#!/bin/sh
###########################################
## Auto Start Event H+2 from Create Date ##
## Ver 0.1                               ##
## inong@kana.co.id                      ##
## 17 June 2015                          ##
###########################################
##
## 20150617 : - Initial scripts
##
##
##

## Configuration

# Date format
TODAY=`date '+%Y-%m-%d'`
NOW=`date '+%s'`
YESTERDAY=`date -d "1 day ago" '+%Y-%m-%d'`


# Direktori dimana script ini disimpan
BASEDIR="/home/gte/region1/tools/cron"

# File-file konfigurasi
LOCK_FILE="$BASEDIR/logs/lock_start-event"

# Database
USERNAME='root'
PASSWORD='em3dbroot'
DATABASE='sscr_region1'
HOST='10.18.69.2'


## Scripts

cd $BASEDIR

#--Cek lock file, kalau tidak ada buat dan jalankan script, kalau tidak ada mati--#
PROC=$(cat $LOCK_FILE)

if [ "$PROC" != "" ]; then
   exit 1
fi

echo "running" > $LOCK_FILE

#--Run Script--#

#mysql -u $USERNAME -p$PASSWORD -h $HOST -D $DATABASE -Bse "update ss_event set n_status = '1' where subdate(date(time_start),1) = '$YESTERDAY' and n_status=0;"
mysql -u $USERNAME -p$PASSWORD -h $HOST -D $DATABASE -Bse "update ss_event set n_status = '1' where date_add(date(date_create),interval 2 day) = '$TODAY' and n_status=0;"

##--Proses selesai, hapus status lock--##
cat /dev/null > $LOCK_FILE

