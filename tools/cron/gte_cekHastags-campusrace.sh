#!/bin/sh

DATE=`date '+%Y%m%d'`

while true 
   do
      #/usr/local/bin/php cekHastags.php >> logs/cekHastags-$DATE.txt 
      /usr/local/bin/php gte_cekHastags.php > /dev/null
      sleep 30
done

