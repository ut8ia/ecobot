<?php

namespace common\services\commander\executions\workers;

use common\helpers\DataSourceHelper;

/**
 * Class GetLocalIp
 * @package common\services\commander\executions\workers
 */
class GetLocalIp extends WorkerAbstract
{


    public function run()
    {
       $this->_result = DataSourceHelper::getLocalIp();
    }

}