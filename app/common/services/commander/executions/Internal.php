<?php

namespace common\services\commander\executions;


use common\services\commander\executions\workers\GetDeviceUid;
use common\services\commander\executions\workers\Unknown;
use common\services\commander\executions\workers\WorkerAbstract;

class Internal extends ExecutorAbstract
{

    const GET_DEVICE_UID = 'GetDeviceUid';


    public function run()
    {

        $worker = $this->makeWorker();
        $worker->run();
        $this->result = $worker->getResult();

    }


    /**
     * @return WorkerAbstract
     */
    public function makeWorker(){
        switch ($this->command->command) {
            case self::GET_DEVICE_UID:
                return new GetDeviceUid($this->command);
                break;
            default:
                return new Unknown();
        }
    }







}