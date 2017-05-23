#!/bin/sh

STATUS=$(curl -s --user 'api:key-031f6c645c2c27d331e152ba8a959e28' -G -d "recipient=ici_surabaya@gmail.com&limit=1" https://api.mailgun.net/v3/gte.supersoccer.co.id/campaigns/fkdf5/events | grep '"event": "bounced"' | awk -F: {'print $11'} | awk -F'"' {'print $2'})

if [[ "$STATUS" != "" ]]; then
	echo "isi"
else
	echo "kosong"
fi
