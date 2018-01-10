<?php

namespace console\controllers;

use Yii;
use common\models\Parameters;
use yii\console\Controller;
use common\models\CertificatesOrders;

/**
 * Class TemperatureController
 * @package console\controllers
 */
class TemperatureController extends Controller
{

    public function actionRead()
    {
        $mult = 10;
        $cycle = 70; // average factor for sensor measurement
        $temp = 0;
        $hum = 0;
        $n = $cycle;
        $c = 0; // count of success readings
        while ($n) {
            $data = shell_exec('sudo /usr/bin/python /home/pi/Adafruit_Python_DHT/examples/temp.py 2302 22');
            $params = explode(';', $data);
            // all params read and second parm exist
            if (is_array($params) and isset($params[1]) and $params[1] < 99 and $params[0] < 40) {
                $temp += $params[0];
                $hum += $params[1];
                $c++;
            }
            $n--;
        }
        $temperature = round((($temp / $c) * $mult), 0);
        $humidity = round((($hum / $c) * $mult), 0);

        Parameters::addRecord(Parameters::TYPE_TEMPERATURE, $temperature);
        Parameters::addRecord(Parameters::TYPE_HUMIDITY, $humidity);
    }

}
