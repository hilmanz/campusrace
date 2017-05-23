#!/bin/sh
###########################################
## Close Event Type 4 (Supersocer Event) ##
## Ver 0.1                         	 ##
## inong@kana.co.id                	 ##
## 04 June 2015                    	 ##
###########################################
##
## 20150604 : - Initial scripts
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
BASEDIR="/home/gte/region1/tools/cron"

# File-file konfigurasi
EVENT_LIST="$BASEDIR/logs/list_locked-close-event.txt"
LOCK_FILE="$BASEDIR/logs/lock_locked-close-event"

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
mysql -u $USERNAME -p$PASSWORD -h $HOST -D $DATABASE -Bse "select id from ss_event where type=4 and n_status = '1' and time_end < NOW();" > $EVENT_LIST


for myEVENT_LIST in `cat $EVENT_LIST`
        do
		CLOSE_TIME=$(mysql -u $USERNAME -p$PASSWORD -h $HOST -D $DATABASE -Bse "select unix_timestamp(time_end) from ss_event where id = '$myEVENT_LIST' and n_status='1';")
		
		TIME_DIFF=`echo "($NOW-$CLOSE_TIME)" | bc`
		
		#echo "$NOW"
		#echo "$CLOSE_TIME"
		#echo "$TIME_DIFF"
		
		if [ "$TIME_DIFF" -gt "$DIFF" ]; then
			mysql -u $USERNAME -p$PASSWORD -h $HOST -D $DATABASE -Bse "update ss_event set n_status = '3' where id = '$myEVENT_LIST' and n_status='1';"
			#echo "event di tutup"
		fi
done

##--Proses selesai, hapus status lock--##
cat /dev/null > $LOCK_FILE
