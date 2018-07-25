<?php

namespace console\controllers;

use common\services\sender\Sender;
use Yii;
use yii\console\Controller;
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
        shell_exec('~/ecobot/app/yii migrate/fresh --interactive=0');

        $report = Reports::create();
        return $report->id;
    }

    /**
     * @return null
     */
    public function actionSend()
    {

        //randomize report burst ( reduce peak loading on aggregation server )
        sleep(mt_rand(1,30));

        $reports = Reports::find()
            ->where(['sent' => null])
            ->all();

        $c = 0;
        if (empty($reports)) {
            return $c;
        }

        $sender = new Sender();
        foreach ($reports as $report) {
            if ($sender->sendReport($report->id)) {
                $c++;
                $report->sent = date("Y-m-d H:i:s", time());
                $report->save();
                $sender->nextCommand();
            }
        }
        return $c;
    }

}
