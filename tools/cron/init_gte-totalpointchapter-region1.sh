#!/bin/sh

##Settings
SERVICE='gte_totalpointchapter-region1.sh'
USERNAME='gte'
DIR='/home/gte/region1/tools/cron'


## Script
ME=`whoami`
as_user() {
  if [ $ME == $USERNAME ] ; then
    bash -c "$1"
  else
    su - $USERNAME -c "$1"
  fi
}

if  pgrep -u $USERNAME -f $SERVICE > /dev/null
   then
     echo "$SERVICE is already running!"
   else
     echo "Starting $SERVICE..."
     cd $DIR
     as_user "cd $DIR && screen -dmS $SERVICE ./$SERVICE"
     sleep 5
     if pgrep -u $USERNAME -f $SERVICE > /dev/null
       then
         echo "$SERVICE is now running."
       else
         echo "Error! Could not start $SERVICE!"
     fi
fi

