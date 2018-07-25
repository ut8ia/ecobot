<?php


namespace common\services\commander\executions\workers;

/**
 * Class GetDeviceUid
 * @package common\services\commander\executions\workers
 */
class Unknown extends WorkerAbstract
{



    public function run()
    {
        $this->_result = 'unknown command';
    }

}