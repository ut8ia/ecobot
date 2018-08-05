<?php

namespace common\services\worker\performers\internalAdapters;

use common\models\Tasks;

/**
 * Class Unknown
 * @package common\services\worker\performers\internalAdapters
 */
class Unknown extends InternalAdapterAbstract
{


    public function run()
    {
        $this->_task->result = 'unknown adapter';
        $this->setRejected();
    }
}