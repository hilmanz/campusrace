#!/bin/sh
###############################################
## Close Event Type 1,2,3 (Chapter Event)    ##
## Ver 0.1                         	     ##
## inong@kana.co.id                	     ##
## 01 JuLy 2015                    	     ##
###############################################
##
## 20150701 : - Initial scripts
##
##
##

## Configuration

# Date format
TODAY=`date '+%Y-%m-%d'`
NOW=`date '+%s'`

# Difference Time
#DIFF='86400' #1 hari
DIFF='172800' #2 hari
#DIFF='300' #5 menit


# Direktori dimana script ini disimpan
BASEDIR="/home/gte/region1/tools/cron"

# File-file konfigurasi
EVENT_LIST="$BASEDIR/logs/list_locked-close-chapter-event.txt"
LOCK_FILE="$BASEDIR/logs/lock_locked-close-chapter-event"

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

#--Run Revenue Report H-8 compare with H-9--#
#mysql -u $USERNAME -p$PASSWORD -h $HOST -D $DATABASE -Bse "select id from ss_event where type in (1,2,3) and n_status = '1' and time_end < NOW();" > $EVENT_LIST
mysql -u $USERNAME -p$PASSWORD -h $HOST -D $DATABASE -Bse "select id from ss_event where type in (1,2,3) and n_status = '1' and upload_foto !='0';"  > $EVENT_LIST

for myEVENTID in `cat $EVENT_LIST`
	do
		myCHAPTERID=$(mysql -u $USERNAME -p$PASSWORD -h $HOST -D $DATABASE -Bse "select chapter_id from ss_event where id=$myEVENTID and type in (1,2,3) and n_status='1';")

		CLOSE_TIME=$(mysql -u $USERNAME -p$PASSWORD -h $HOST -D $DATABASE -Bse "select unix_timestamp(time_end) from ss_event where id = '$myEVENTID' and n_status='1';")
		
		TIME_DIFF=`echo "($NOW-$CLOSE_TIME)" | bc`
		
		echo "$NOW"
		echo "$CLOSE_TIME"
		echo "$TIME_DIFF"
		
		if [ "$TIME_DIFF" -gt "$DIFF" ]; then
			mysql -u $USERNAME -p$PASSWORD -h $HOST -D $DATABASE -Bse "insert into ss_activity_log set type_paremeter_point=12,event_id='$myEVENTID',chapter_id='$myCHAPTERID',date=NOW(),point='50';"
			mysql -u $USERNAME -p$PASSWORD -h $HOST -D $DATABASE -Bse "update ss_chapter set point=point+50 where id='$myCHAPTERID';"
			mysql -u $USERNAME -p$PASSWORD -h $HOST -D $DATABASE -Bse "update ss_event set n_status='3',point='50' where id = '$myEVENTID' and n_status='1';"
			#echo "event di tutup"
		fi
done

##--Proses selesai, hapus status lock--##
cat /dev/null > $LOCK_FILE
