<?php

namespace console\controllers;

use common\services\commander\Commander;
use common\services\commander\models\Command;
use Yii;
use yii\console\Controller;

/**
 * @package console\controllers
 */
class CommandController extends Controller
{


    public function actionRun($command)
    {
        $c = new Command();
        $c->type = Command::TYPE_EVENT;
        $c->command = $command;
        $c->received = date("Y-m-d H:i:s", time());
        $c->uid = Yii::$app->security->generateRandomString(32);

        $exec = Commander::makeExec($c);
        $exec->run();
        echo $exec->getResult();
        echo $exec->sendResponse();
    }



}
