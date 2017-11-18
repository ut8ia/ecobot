<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\models\CertificatesOrders;
use common\models\Readings;

/**
 * Manage certificate order
 * @package console\controllers
 */
class TempController extends Controller
{

    public function actionRead()
    {
        $mult = 10;
        $cycle = 100; // average factor for sensor measurement
        $temp = 0;
        $hum = 0;
        $n = $cycle;
        $c = 0; // count of success readings
        while ($n) {
            $data = shell_exec('sudo /usr/bin/python /home/pi/Adafruit_Python_DHT/examples/temp.py 2302 22');
            $params = explode(';', $data);
            // all params read and second parm exist
            if (is_array($params) and isset($params[1]) and $params[1] < 99) {
                $temp += $params[0];
                $hum += $params[1];
                $c++;
            }
            $n--;
        }
        $tempereture = round((($temp / $c) * $mult), 0);
        $humidity = round((($hum / $c) * $mult), 0);

        Readings::add(Readings::TYPE_TEMPERATURE, $tempereture);
        Readings::add(Readings::TYPE_HUMIDITY, $humidity);
    }

}
