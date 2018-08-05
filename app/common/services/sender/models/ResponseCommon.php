<?php

namespace common\services\sender\models;

use common\services\sender\models\data\ResponseDataCommon;
use Yii;
use yii\base\Model;

 class ResponseCommon extends Model
{

    public $data;
    public $hash;

    private $dataModel;

    public function formName()
    {
        return 'Response';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['data', 'hash'], 'required'],
            ['data', 'validateData'],
            ['hash', 'checkHash']
        ];
    }

     /**
      * @return ResponseDataCommon
      */
    public function getResponseData()
    {
        return $this->dataModel;
    }


     /**
      * @return bool
      */
     public function validateData()
     {
         $this->dataModel = new ResponseDataCommon();
         $this->dataModel->load(['ResponseDataCommon' => $this->data]);
         return $this->dataModel->validate();
     }

     /**
      * @return boolean
      */
     public function isSuccess()
     {
         return $this->dataModel->success;
     }


    /**
     * @return bool
     */
    public function checkHash()
    {
        $computedHash = hash_hmac(
            'md5',
            json_encode($this->data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
            Yii::$app->settings->hashkey
        );

        if ($this->hash === $computedHash) {
            return true;
        }
        $this->addError('Hash is not valid');
        return false;
    }



}