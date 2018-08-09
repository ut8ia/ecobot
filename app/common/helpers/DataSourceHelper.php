<?php

namespace common\helpers;


class DataSourceHelper
{

    /**
     * @return string
     */
    public static function getDeviceSerial()
    {
        $raw = shell_exec('cat /proc/cpuinfo | grep Serial | cut -d \' \' -f 2');

        //clean new lines
        return trim(preg_replace('/\s+/', ' ', $raw));
    }


    /**
     * @return string
     */
    public static function getLocalIp(){

        return shell_exec('ifconfig | sed -En \'s/127.0.0.1//;s/.*inet (addr:)?(([0-9]*\.){3}[0-9]*).*/\2/p\'');

    }

}