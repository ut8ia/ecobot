<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\models\CertificatesOrders;
use common\models\Reports;

/**
 * Manage certificate order
 * @package console\controllers
 */
class ReportController extends Controller
{

    /**
     * @return int
     */
    public function actionCreate()
    {
        $report = Reports::create();
        return $report->id;
    }

    /**
     * @return null
     */
    public function actionSend(){
        return null;
    }

}
