<?php

namespace console\controllers;

use common\models\Parameters;
use Yii;
use yii\console\Controller;
use common\models\CertificatesOrders;
use common\models\Readings;

/**
 * Manage certificate order
 * @package console\controllers
 */
class DustController extends Controller
{

    public function actionRead()
    {
        $cycle = 40; // average factor for sensor measurement
        $d10 = 0;
        $d25 = 0;

        $n = $cycle;
        $c = 0; // count of success readings
        $trueFactorMax = 1.3;
        $trueFactorMin = 0.7;

        while ($n) {
            $data = shell_exec('sudo /home/pi/ecobot/app/console/commands/dust.sh');
            $params = explode(';', $data);

            // possible bad data
            if (is_array($params) && isset($params[1])) {

                // trust in first measurement
                if (!$c) {
                    $d10 += $params[0];
                    $d25 += $params[1];
                    $c++;
                    continue;
                }

                // possible wrong data from sensor far from avarage values
                $av10 = (($d10 / $c) / $params[0]); // factor dust 10um
                $av25 = (($d25 / $c) / $params[1]); // factor dust 2,5um

                $true10 = ($av10 < $trueFactorMax and $av10 > $trueFactorMin);
                $true25 = ($av25 < $trueFactorMax and $av25 > $trueFactorMin);

                if ($true10 && $true25) {
                    $d10 += $params[0];
                    $d25 += $params[1];
                    $c++;
                }
            }
            $n--;
            sleep(4);
        }

        $dust10 = round(($d10 / $c), 0);
        $dust25 = round(($d25 / $c), 0);

        Parameters::addRecord(Parameters::TYPE_DUST10, $dust10);
        Parameters::addRecord(Parameters::TYPE_DUST25, $dust25);
    }

}
