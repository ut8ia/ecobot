<?php

namespace common\services\sender\models\data;

use common\services\commander\models\Command;
use Yii;
use yii\base\Model;

/**
 * Class  ResponseDataModel
 * @package common\services\sender\models\data
 *
 * @property integer $mktime
 * @property boolean $success
 * @property array $command
 */
class ResponseDataCommon extends Model
{

    public $mktime;
    public $success = false;
    public $command;

    private $_nextCommand;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mktime', 'success'], 'required'],
            ['command', 'checkCommand']
        ];
    }


    public function checkCommand()
    {
        if (null === $this->command) {
            return null;
        }


        $command = new Command();
        try {
            $command->command = $this->command['command'];
            $command->type = $this->command['type'];
            $command->uid = $this->command['uid'];
            $command->payload = $this->command['payload'];
            $command->received = date("Y-m-d H:i:s", time());

        } catch (\Exception $e) {
            unset($e);
        }

        if($command->validate()){
            $this->_nextCommand = $command;
        }
    }

    /**
     * @return Command
     */
    public function getNextCommand(){
        return $this->_nextCommand;
    }

    /**
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->toArray(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}