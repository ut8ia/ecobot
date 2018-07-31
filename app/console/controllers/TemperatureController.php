<?php

namespace console\controllers;

use Yii;
use common\models\Parameters;
use yii\console\Controller;

/**
 * Class TemperatureController
 * @package console\controllers
 */
class TemperatureController extends Controller
{


    public function actionRead()
    {
        $mult = 10;
        $temp = 0;
        $hum = 0;
        $n = 15;
        $c = 0; // count of success readings

        // to prevent single mistakes - measure between -15 ... +40 C
        while ($n) {
            $data = shell_exec('sudo /usr/bin/python /home/pi/Adafruit_Python_DHT/examples/temp.py 2302 22');
            $params = explode(';', $data);
            // all params read and second parm exist
            if (is_array($params) and isset($params[1]) and $params[1] < 100 and $params[0] < 40 and $params[0] > -15) {
                $temp += $params[0];
                $hum += $params[1];
                $c++;
            }
            $n--;
        }

        // if no success readings - try more wide band -29 .... +60 C
        if (!$c) {
            $n = 15;
            while ($n) {
                $data = shell_exec('sudo /usr/bin/python /home/pi/Adafruit_Python_DHT/examples/temp.py 2302 22');
                $params = explode(';', $data);
                // all params read and second parm exist
                if (is_array($params) and isset($params[1]) and $params[1] < 100 and $params[0] < 60 and $params[0] > -29) {
                    $temp += $params[0];
                    $hum += $params[1];
                    $c++;
                }
                $n--;
            }

        }

        $temperature = round((($temp / $c) * $mult), 0) + Yii::$app->settings->tempCorrection;
        $humidity = round((($hum / $c) * $mult), 0) + Yii::$app->settings->humidityCorrection;

        Parameters::addRecord(Parameters::TYPE_TEMPERATURE, $temperature);
        Parameters::addRecord(Parameters::TYPE_HUMIDITY, $humidity);
    }

}
