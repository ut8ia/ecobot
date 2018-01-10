<?php

namespace console\controllers;

use common\models\Parameters;
use Yii;
use yii\console\Controller;
use common\models\CertificatesOrders;
use common\models\Reports;

/**
 * @package console\controllers
 */
class CheckController extends Controller
{

    /**
     *  reboot if no parameter in latest report
     */
    public function actionDust()
    {
        if (!Parameters::checkParameter(Parameters::TYPE_DUST25)) {
            Yii::error('reboot command due dust densor failures','DUST');
            shell_exec('sudo shutdown -r now');
        }
    }


}
