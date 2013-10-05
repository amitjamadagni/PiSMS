#!/bin/bash
while true; do

inotifywait -e create /var/www/web  && \
./sms1.sh

done
