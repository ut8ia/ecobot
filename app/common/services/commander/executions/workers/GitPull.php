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
       $this->_result = shell_exec('cd ~/ecobot ; git pull origin master');
    }

}