<?php


namespace common\services\commander\executions\workers;

/**
 * Class MigrateNew
 * @package common\services\commander\executions\workers
 */
class MigrateNew extends WorkerAbstract
{



    public function run()
    {
       $this->_result = shell_exec('~/ecobot/app/yii migrate --interactive=0');
    }

}