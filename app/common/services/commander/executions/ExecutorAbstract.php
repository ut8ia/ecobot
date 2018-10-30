<?php

namespace common\services\commander\executions;

use common\services\commander\models\Command;
use common\services\sender\Sender;
use Yii;

/**
 * Class CommandAbstract
 * @package common\services\commander\executions
 * @property Command $command
 * @property string $_result
 */
abstract class ExecutorAbstract
{
    /**
     * @var  Command $command
     */
    protected $command;

    /** @var  string $result */
    protected $_result;

    /**
     * ExecutorAbstract constructor.
     * @param Command $command
     */
    public function __construct(Command $command)
    {
        $this->command = $command;
    }

    public abstract function run();


    /**
     * @return string
     */
    public function getResult()
    {
        return $this->_result;
    }


    /**
     *  send result and recursive execution of next given command
     */
    public function sendResponse()
    {

        $sender = new Sender();
        $this->command->result = $this->result;
        $this->command->save();

        if ($sender->sendCommandResult($this->command)) {

            $this->command->sent = date("Y-m-d H:i:s", time());
            $this->command->save();

            // next command recursive execution
            $sender->nextCommand();
        }


    }


}