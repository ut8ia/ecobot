<?php

namespace common\services\sender\models\data;

use common\models\Reports;
use Yii;
use yii\base\Model;

/**
 * Class RequestDataModel
 * @package common\services\sender\models\data
 *
 * @property integer $mktime
 * @property array $report
 * @property array $parameters
 */
class RequestDataModel extends Model
{

    public $mktime;
    public $report;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mktime', 'report'], 'required'],
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