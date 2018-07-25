<?php

namespace common\services\commander\executions\workers;

use common\services\commander\models\Command;

/**
 * Class WorkerAbstract
 * @package common\services\commander\executions\workers
 * @property Command $command
 * @property string $_result
 */
abstract class WorkerAbstract {

    protected $command;

    protected $_result;

    /**
     * ExecutorAbstract constructor.
     * @param Command $command
     */
    public function __construct(Command $command)
    {
        $this->command = $command;
    }

    abstract public function run();

    public function getResult(){
        return $this->_result;
    }


}