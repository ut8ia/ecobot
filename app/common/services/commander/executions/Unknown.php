<?php

namespace common\services\commander\executions;


class Unknown extends ExecutorAbstract
{

    /**
     *
     */
    public function run()
    {
        $this->result ='unknown operation';
    }

}