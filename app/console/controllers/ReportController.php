<?php

namespace console\controllers;

use common\services\sender\Sender;
use Yii;
use yii\console\Controller;
use common\models\CertificatesOrders;
use common\models\Reports;

/**
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
    public function actionSend()
    {

        $reports = Reports::find()
            ->where(['sent' => null])
            ->all();

        $c = 0;
        if (empty($reports)) {
            return $c;
        }

        $sender = new Sender();
        foreach ($reports as $report) {
            if ($sender->send($report->id)) {
                $c++;
                $report->sent = time();
                $report->save();
            }
        }
        return $c;
    }

}