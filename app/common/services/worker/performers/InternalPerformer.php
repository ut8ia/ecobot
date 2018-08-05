<?php

namespace common\services\worker\performers;

use common\services\worker\performers\internalAdapters\InternalAdapterAbstract;
use common\services\worker\performers\internalAdapters\Unknown;
use common\services\worker\performers\PerformerAbstract;

class InternalPerformer extends PerformerAbstract
{


    public function run()
    {
        $adapter = $this->makeAdapter();
        $adapter->run();
    }


    /**
     * @return InternalAdapterAbstract
     */
    private function makeAdapter()
    {
        $className = "common\services\worker\performers\internalAdapters\\" . $this->_task->name;

        if (class_exists($className)) {
            $adapter = new $className($this->_task);
        } else {
            $adapter = new Unknown($this->_task);
        }

        return $adapter;
    }


}