<?php

namespace console\controllers;

use common\services\worker\Worker;
use Yii;
use yii\console\Controller;

/**
 * @package console\controllers
 */
class TaskController extends Controller
{


    public function actionRun()
    {
        Worker::runNext();
    }


}
