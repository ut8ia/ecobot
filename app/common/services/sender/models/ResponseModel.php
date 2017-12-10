<?php

namespace common\services\sender\models;

use common\services\sender\models\data\ResponseDataModel;
use Yii;
use yii\base\Model;

class ResponseModel extends Model
{

    public $data;
    public $hash;

    private $dataModel;

    public function rules()
    {
        return [
            [['data', 'hash'], 'required'],
            ['data', 'validateData'],
            ['hash', 'checkHash']
        ];
    }

    /**
     * @return bool
     */
    public function checkHash()
    {
        $computedHash = hash_hmac(
            'md5',
            json_encode($this->data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
            Yii::$app->params['hashkey']
        );

        if ($this->hash === $computedHash) {
            return true;
        }
        $this->addError('Hash is not valid');
        return false;
    }


    /**
     * @return bool
     */
    public function validateData()
    {
        $this->dataModel = new ResponseDataModel();
        $this->dataModel->load(['ResponseDataModel' => $this->data]);
        return $this->dataModel->validate();
    }

    /**
     * @return boolean
     */
    public function isSuccess()
    {
        return $this->dataModel->success;
    }

}