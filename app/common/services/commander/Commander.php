<?php

namespace common\services\commander;

use common\services\commander\executions\Event;
use common\services\commander\executions\Internal;
use common\services\commander\executions\Shell;
use common\services\commander\executions\Unknown;
use common\services\commander\models\Command;
use Yii;
use yii\base\BaseObject;

class Commander extends BaseObject
{

    /**
     * @param Command $command
     */
    public static function makeExec(Command $command)
    {

        $command = self::checkDuplicate($command);

        switch ($command->type) {
            case Command::TYPE_SHELL:
                return new Shell($command);
                break;
            case Command::TYPE_INTERNAL:
                return new Internal($command);
                break;
            case Command::TYPE_EVENT:
                return new Event($command);
                break;
            default:
                return new Unknown($command);
        }
    }


    /**
     * @param Command $command
     * @return Command|null|static
     *
     * we dont save duplicated comands.
     * try to run previous stored with same uid
     *
     */
    public static function checkDuplicate(Command $command)
    {
        $found = Command::findOne(['uid' => $command->uid]);
        if ($found) {
            return $found;
        }
        return $command;
    }


    /**
     * @param Command $command
     */
    public static function runRecursion(Command $command)
    {
        $exec = Commander::makeExec($command);
        $exec->run();
        $exec->sendResponse();

    }

}