<?php

namespace common\services\sender\models\data;

use common\models\Reports;
use common\services\commander\models\Command;
use Yii;
use yii\base\Model;

/**
 * Class RequestCommandData
 * @package common\services\sender\models\data
 *
 * @property integer $mktime
 * @property array $command
 */
class RequestCommandData extends Model
{

    public $mktime;
    public $command;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mktime', 'command'], 'required'],
        ];
    }

    /**
     * @param Command $command
     */
    public function prepare($command)
    {
        $this->mktime = time();
        $this->command = $command->attributes;
    }

    /**
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->toArray(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}