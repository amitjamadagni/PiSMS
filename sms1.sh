#!/bin/bash

WORKINGDIR=/var/www/web

cd $WORKINGDIR
mkdir -p used

for file in *.txt; do
if [ $file == "*.txt" ]; then
break
fi
./sms.sh "$file";

mv "$file" used
done;
