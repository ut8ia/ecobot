<?php

use common\models\Tasks;
use yii\db\Schema;
use yii\db\Migration;

class m180804_141015_register extends Migration
{
    public function safeUp()
    {
        $task = new Tasks();
        $task->name ='Register';
        $task->type = Tasks::TYPE_INTERNAL;
        $task->status = Tasks::STATUS_NEW;
        $task->uid = Yii::$app->security->generateRandomString(32);
        $task->save();
    }

    public function safeDown()
    {
       return null;
    }
}
