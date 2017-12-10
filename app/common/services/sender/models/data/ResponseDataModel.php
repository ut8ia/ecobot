<?php

namespace common\services\sender\models\data;

use common\models\Reports;
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
class ResponseDataModel extends Model
{

    public $mktime;
    public $success = false;
    public $command = [];


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mktime', 'success'], 'required'],
            ['command', 'safe']
        ];
    }

    /**
     * @param $reportId
     */
    public function prepare($reportId)
    {
        $this->mktime = time();
        $this->report = Reports::find()
            ->where(['id' => $reportId])
            ->with('parameters')
            ->asArray()
            ->one();
    }

    /**
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->toArray(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}