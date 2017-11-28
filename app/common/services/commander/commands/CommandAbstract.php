<?php

namespace common\services\commander\commands;


abstract class CommandAbstract
{

    /** @var  string $command */
    public $command;

    /** @var  string $result */
    private $result;


    public abstract function execute();


    /**
     * @return string
     */
    public function getResult()
    {
        return $this->result;
    }


}