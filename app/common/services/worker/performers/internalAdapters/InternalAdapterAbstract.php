<?php

namespace common\services\worker\performers\internalAdapters;

use common\models\Tasks;

/**
 * Class InternalAdapterAbstract
 * @package common\services\worker\performers\internalAdapters
 */
abstract class InternalAdapterAbstract
{


    protected $_task;

    public function __construct(Tasks $task)
    {
        $this->_task = $task;
    }

    abstract public function run();

    public function getTask()
    {
        return $this->_task;
    }


    protected function setNew()
    {
        $this->_task->status = Tasks::STATUS_NEW;
        $this->_task->save();
    }

    protected function setProgress()
    {
        $this->_task->status = Tasks::STATUS_PROGRESS;
        $this->_task->save();
    }

    protected function setRejected()
    {
        $this->_task->status = Tasks::STATUS_REJECTED;
        $this->_task->save();
    }

    protected function setDone()
    {
        $this->_task->status = Tasks::STATUS_DONE;
        $this->_task->save();
    }


}