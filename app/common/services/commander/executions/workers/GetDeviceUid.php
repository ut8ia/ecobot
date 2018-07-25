<?php


namespace common\services\commander\executions\workers;

/**
 * Class GetDeviceUid
 * @package common\services\commander\executions\workers
 */
class GetDeviceUid extends WorkerAbstract
{



    public function run()
    {
       $this->_result = shell_exec('cat /proc/cpuinfo | grep Serial | cut -d \' \' -f 2');
    }

}