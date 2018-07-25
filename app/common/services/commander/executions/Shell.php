<?php

namespace common\services\commander\executions;

/**
 * Class Shell
 * @package common\services\commander\executions
 */
class Shell extends ExecutorAbstract
{


    /**
     *  execute shell command
     */
    public function run()
    {
        $this->result = shell_exec($this->command->command);
    }

}