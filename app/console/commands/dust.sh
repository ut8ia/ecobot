#!/bin/bash
# SDS011 reader, assuming /dev/ttyUSB0
# Based on examples from: http://kuehnast.com/s9y/archives/633-Feinstaubmessung_mit_dem_Raspberry_Pi.html
# by lukasz.jokiel@gmail.com, 2017, NO WARRANTY, GPL v2
#
# Variables, change if needed

serial_port="/dev/ttyUSB0"

#Turning ON the USB ports - this is ONLY valid for left side of Orange Pi (A20)
#/usr/bin/sunxi-pio -m PH26''

#Waiting for the fan spinup
#sleep 60

#Main program
#Set the port

/bin/stty -F $serial_port 9600 raw

#Read data from serial port
RAW_DATA=`/usr/bin/od --endian=big -x -N10 < /dev/ttyUSB0 | /usr/bin/head -n 1 | /usr/bin/cut -f2-10 -d" "`
HEADER=`echo $RAW_DATA | awk '{print $1}'`

#Probe for propper header
if [ "$HEADER" = "aac0" ];
then
#Let us cut the RAW DATA and put it into variables - data is in hexadecimals
HEX_PPM25_L=$(echo $RAW_DATA|cut -f2 -d " "|cut -b1-2);
HEX_PPM25_H=$(echo $RAW_DATA|cut -f2 -d " "|cut -b3-4);
HEX_PPM10_L=$(echo $RAW_DATA|cut -f3 -d " "|cut -b1-2);
HEX_PPM10_H=$(echo $RAW_DATA|cut -f3 -d " "|cut -b3-4);

#Convert variables to decimals

PPM25_L=$(echo $((0x$HEX_PPM25_L)));
PPM25_H=$(echo $((0x$HEX_PPM25_H)));
PPM10_L=$(echo $((0x$HEX_PPM10_L)));
PPM10_H=$(echo $((0x$HEX_PPM10_H)));

#More simple math
PPM25=`echo "((${PPM25_H}*256)+${PPM25_L})/10" | bc`
PPM10=`echo "((${PPM10_H}*256)+${PPM10_L})/10" | bc`

#Update the local InfluxDB
echo $PPM10';'$PPM25
#/usr/bin/curl -i -XPOST 'http://127.0.0.1:8086/write?db=smogdb' --data-binary "ppm25sds011 value=${PPM25}"
#/usr/bin/curl -i -XPOST 'http://127.0.0.1:8086/write?db=smogdb' --data-binary "ppm10sds011 value=${PPM10}"

#echo HEADER ERROR
fi

#Turining OFF the USB ports for Orange Pi

#/usr/bin/sunxi-pio -m PH26''