<?php

namespace console\controllers;

use common\models\Parameters;
use Yii;
use yii\console\Controller;
use common\models\CertificatesOrders;
use common\models\Readings;

/**
 * @package console\controllers
 */
class DustController extends Controller
{

    private $cycle = 18; // average factor for sensor measurement
    private $maxValue10 = 400; // max valid value
    private $maxValue25 = 120; // max valid value
    private $timeout = 5; // seconds between measurements
    private $dispersiaBorderMax = 1.7; // dispersia route border
    private $dispersiaBorderMin = 0.35; // dispersia route border

    private function readDust()
    {

        // enable power on dust sensor thru mosfet on pin 23
        shell_exec('echo "1" > /sys/class/gpio/gpio23/value');
        // wait for cooler reach proper rpm
        sleep(15);

        $d10 = 0;
        $d25 = 0;

        $n = $this->cycle;
        $c = 0; // count of success readings
        while ($n) {
            $data = shell_exec('sudo /home/pi/ecobot/app/console/commands/dust.sh');
            $params = explode(';', $data);

            // possible bad data
            if (is_array($params) && isset($params[1])) {

                // skip on bad values ( more than max )
                if ($params[0] > $this->maxValue10 || $params[1] > $this->maxValue25) {
                    $n++;
                    continue;
                }

                $params[0] = $params[0] < 3 ? 3 : $params[0];
                $params[1] = $params[1] < 3 ? 3 : $params[1];

                // trust in first measurement
                if (!$c) {
                    $d10 += $params[0];
                    $d25 += $params[1];
                    $c++;
                    continue;
                }

                // possible wrong data from sensor far from average values
                $av10 = (($d10 / $c) / $params[0]); // factor dust 10um
                $av25 = (($d25 / $c) / $params[1]); // factor dust 2,5um

                $true10 = ($av10 < $this->dispersiaBorderMax and $av10 > $this->dispersiaBorderMin);
                $true25 = ($av25 < $this->dispersiaBorderMax and $av25 > $this->dispersiaBorderMin);

                if ($true10 && $true25) {
                    $d10 += $params[0];
                    $d25 += $params[1];
                    $c++;
                }
            }
            $n--;
            sleep($this->timeout);
        }

        $dust10 = round(($d10 / $c) * Yii::$app->params['dust10Correction'], 0);
        $dust25 = round(($d25 / $c) * Yii::$app->params['dust25Correction'], 0);

        Parameters::addRecord(Parameters::TYPE_DUST10, $dust10);
        Parameters::addRecord(Parameters::TYPE_DUST25, $dust25);

        // disable power on dust sensor thru mosfet on pin 23
        shell_exec('echo "0" > /sys/class/gpio/gpio23/value');

    }

    public function actionRead()
    {
        $this->readDust();
    }


    /**
     * second read probe - if first is bad
     * shortly and maximum range up to 1000ppm
     */
    public function actionReadShort()
    {
        if (Parameters::checkParameter(Parameters::TYPE_DUST25)) {
            return false;
        }
        Yii::error('second dust reading', 'DUST');
        $this->cycle = 10;
        $this->maxValue10 = 1600;
        $this->maxValue25 = 800;
        $this->timeout = 7;
        $this->readDust();
    }
}
