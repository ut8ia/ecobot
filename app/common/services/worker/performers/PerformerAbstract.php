<?php

namespace common\services\worker\performers;

use common\models\Tasks;

/**
 * Class PerformerAbstract
 * @package common\services\worker\performers
 * @property Tasks $task
 */
abstract class PerformerAbstract
{

    protected $_task;

    /**
     * PerformerAbstract constructor.
     * @param Tasks $task
     */
    public function __construct($task)
    {
        $this->_task = $task;
    }

    /**
     * @return Tasks
     */
    public function getTask()
    {
        return $this->_task;
    }

    abstract public function run();


}