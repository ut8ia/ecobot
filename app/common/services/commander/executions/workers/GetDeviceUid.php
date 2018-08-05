<?php

namespace common\services\commander\executions\workers;

use common\helpers\DataSourceHelper;

/**
 * Class GetDeviceUid
 * @package common\services\commander\executions\workers
 */
class GetDeviceUid extends WorkerAbstract
{


    public function run()
    {
       $this->_result = DataSourceHelper::getDeviceSerial();
    }

}