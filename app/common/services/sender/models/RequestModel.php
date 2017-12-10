<?php

namespace common\services\sender\models;

use common\services\sender\models\data\RequestDataModel;
use Yii;
use yii\base\Model;

class RequestModel extends Model
{

    public $data;
    public $hash;

    /**
     * @param $reportId
     * @return bool
     */
    public function prepare($reportId)
    {

        $dataModel = new RequestDataModel();
        $dataModel->prepare($reportId);
        if (!$dataModel->validate()) {
            return false;
        }
        $this->data = $dataModel->toArray();
        $this->makeHash($dataModel->toJson());
        return true;
    }

    private function makeHash($data)
    {
        $this->hash = hash_hmac('md5', $data, Yii::$app->params['hashkey']);
    }

    /**
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->toArray(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}