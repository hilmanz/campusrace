#!/bin/sh
#####################################
## Close Challenge                 ##
## Ver 0.1                         ##
## inong@kana.co.id                ##
## 29 June 2015                    ##
#####################################
##
## 20150629 : - Initial scripts
##
##
##

## Configuration

# Date format
TODAY=`date '+%Y-%m-%d'`
NOW=`date '+%s'`

# Difference Time
DIFF='3600'

# Direktori dimana script ini disimpan
BASEDIR="/home/gte/campusrace/tools/cron"

# File-file konfigurasi
CHALLENGE_LIST="$BASEDIR/logs/list_locked-close-challenge.txt"
LOCK_FILE="$BASEDIR/logs/lock_locked-close-challenge"

# Database
USERNAME='root'
PASSWORD='em3dbroot'
DATABASE='ss_campus_race'
HOST='10.18.69.2'

## Scripts

cd $BASEDIR

#--Cek lock file, kalau tidak ada buat dan jalankan script, kalau tidak ada mati--#
PROC=$(cat $LOCK_FILE)

if [ "$PROC" != "" ]; then
   exit 1
fi

echo "running" > $LOCK_FILE

#--Run Revenue Report H-8 compare with H-9--#
mysql -u $USERNAME -p$PASSWORD -h $HOST -D $DATABASE -Bse "select id from ss_chalangge where n_status = '1' and end_time < NOW();" > $CHALLENGE_LIST


for myCHALLENGE_LIST in `cat $CHALLENGE_LIST`
        do
		CLOSE_TIME=$(mysql -u $USERNAME -p$PASSWORD -h $HOST -D $DATABASE -Bse "select unix_timestamp(end_time) from ss_chalangge where id = '$myCHALLENGE_LIST' and n_status='1';")
		
		TIME_DIFF=`echo "($NOW-$CLOSE_TIME)" | bc`
		
		#echo "$NOW"
		#echo "$CLOSE_TIME"
		#echo "$TIME_DIFF"
		
		if [ "$TIME_DIFF" -gt "$DIFF" ]; then
			mysql -u $USERNAME -p$PASSWORD -h $HOST -D $DATABASE -Bse "update ss_chalangge set n_status = '3' where id = '$myCHALLENGE_LIST' and n_status='1';"
			#echo "event di tutup"
		fi
done

##--Proses selesai, hapus status lock--##
cat /dev/null > $LOCK_FILE
