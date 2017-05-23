#!/bin/sh

DATE=`date '+%Y%m%d'`

while true 
   do
      #/usr/local/bin/php cekHastags.php >> logs/cekHastags-$DATE.txt 
      /usr/bin/curl http://gte.supersoccer.co.id/sscrregion1/service/checkEmailStatus/checkMail
      sleep 30 
done

