<?php

namespace common\helpers;


class DataSourceHelper
{


    public static function getDeviceSerial()
    {
        $raw = shell_exec('cat /proc/cpuinfo | grep Serial | cut -d \' \' -f 2');

        //clean new lines
        return trim(preg_replace('/\s+/', ' ', $raw));
    }

}