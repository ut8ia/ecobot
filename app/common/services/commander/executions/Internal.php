<?php

namespace common\services\commander\executions;


use common\services\commander\executions\workers\ApplySettings;
use common\services\commander\executions\workers\GetDeviceUid;
use common\services\commander\executions\workers\GitPull;
use common\services\commander\executions\workers\MigrateFresh;
use common\services\commander\executions\workers\MigrateNew;
use common\services\commander\executions\workers\Unknown;
use common\services\commander\executions\workers\WorkerAbstract;

class Internal extends ExecutorAbstract
{

    const GET_DEVICE_UID = 'GetDeviceUid';
    const MIGRATE_NEW = 'MigrateNew';
    const MIGRATE_FRESH = 'MigrateFresh';
    const APPLY_SETTINGS = 'ApplySettings';
    const GIT_PULL = 'GitPull';

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
            case self::MIGRATE_NEW:
                return new MigrateNew($this->command);
                break;
            case self::MIGRATE_FRESH:
                return new MigrateFresh($this->command);
                break;
            case self::APPLY_SETTINGS:
                return new ApplySettings($this->command);
                break;
            case self::GIT_PULL:
                return new GitPull($this->command);
                break;
            default:
                return new Unknown();
        }
    }







}