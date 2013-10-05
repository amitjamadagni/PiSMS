SMSC="+919822078000"
INPUT="$1"
#INPUT="/var/www/web/used/test.txt"
OLDIFS=$IFS
IFS=,
[ ! -f $INPUT ] && { echo "$INPUT file not found"; exit 99; }
while read message number ; do 
    echo $message # or whaterver you want to do with the $line variable
    #j=$[$(line)]
    echo $number
    echo "$message" | gnokii --sendsms $number --smsc $SMSC
done < $INPUT
IFS=$OLDIFS

