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

    public function actionDust()
    {
        $dust25 = Parameters::find()
            ->where(['report_id' => Reports::findLastId()])
            ->andWhere(['type' => Parameters::TYPE_DUST25])
            ->one();
        if (null === $dust25) {
            shell_exec('sudo shutdown -r now');
        }
    }


}
