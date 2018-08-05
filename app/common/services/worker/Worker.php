<?php

namespace common\services\worker;

use common\models\Tasks;
use common\services\worker\performers\ExternalPerformer;
use common\services\worker\performers\InternalPerformer;

class Worker
{


    /**
     * @param Tasks $task
     * @return Tasks
     */
    public static function run(Tasks $task)
    {
        $performer = self::makePerformer($task);
        $performer->run();
        return $performer->getTask();

    }


    /**
     * @return Tasks|null
     */
    public static function runNext()
    {
        $task = Tasks::find()
            ->where(['status' => Tasks::STATUS_NEW])
            ->one();

        if (null === $task) {
            return null;
        }

        return self::run($task);

    }


    /**
     * @param Tasks $task
     * @return ExternalPerformer|InternalPerformer
     */
    public static function makePerformer(Tasks $task)
    {

        switch ($task->type) {

            case Tasks::TYPE_INTERNAL:
                return new InternalPerformer($task);
                break;
            case Tasks::TYPE_EXTERNAL:
                return new ExternalPerformer($task);
                break;
            default:
                return new InternalPerformer($task);
        }

    }


}