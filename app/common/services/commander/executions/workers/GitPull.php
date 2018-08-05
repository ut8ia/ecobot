<?php


namespace common\services\commander\executions\workers;

/**
 * Class GotPull
 * @package common\services\commander\executions\workers
 */
class GitPull extends WorkerAbstract
{


    public function run()
    {
        $result = shell_exec('cd ~/ecobot ; git pull origin master');
        $this->_result = (string)$result;
    }

}