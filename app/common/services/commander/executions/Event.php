<?php

namespace common\services\commander\executions;

/**
 * Class Event
 * @package common\services\commander\executions
 */
class Event extends ExecutorAbstract
{


    /**
     *  execute shell command
     */
    public function run()
    {
        $this->result = shell_exec($this->command->command);
    }

}