<?php

namespace common\services\sender;

use common\services\sender\models\RequestModel;
use common\services\sender\models\ResponseModel;
use yii\base\BaseObject;
use Yii;

class Sender extends BaseObject
{

    private $host;
    private $key;
    private $endpoint;

    private $body;

    public function init()
    {
        $this->host = Yii::$app->params['apihost'];
        $this->key =  Yii::$app->params['apikey'];
    }

    public function send($reportId)
    {
        $this->endpoint = 'v1/report';

        $requestModel = new RequestModel();
        if (!$requestModel->prepare($reportId)) {
            return false;
        }
        $this->body = $requestModel->toJson();
        return $this->makeRequest();
    }

    public function makeCallback()
    {

    }


    /**
     * @return bool
     */
    private function makeRequest()
    {

        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->key];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $this->host . $this->endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->body);
        curl_setopt($ch, CURLOPT_POST, 1);

        try {
            $response = curl_exec($ch);
        } catch (\Exception $e) {
            return false;
        }

        return $this->catchResponse($response);

    }


    /**
     * @param $response
     * @return boolean
     */
    private function catchResponse($response)
    {
        $responseModel = new ResponseModel();
        $responseModel->load(['ResponseModel' => json_decode($response, true)]);
        $responseModel->validate();
        return $responseModel->isSuccess();
    }


}