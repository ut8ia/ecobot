<?php

namespace common\services\sender;

use common\services\commander\Commander;
use common\services\commander\models\Command;
use common\services\sender\models\RequestCommand;
use common\services\sender\models\RequestRegister;
use common\services\sender\models\RequestReport;
use common\services\sender\models\ResponseCommand;
use common\services\sender\models\ResponseCommon;
use common\services\sender\models\ResponseReport;
use yii\base\BaseObject;
use Yii;

class Sender extends BaseObject
{

    private $host;
    private $key;
    private $endpoint;

    private $body;

    /**
     * @var ResponseCommon $responseModel
     */
    private $responseModel;

    public function init()
    {
        $this->host = Yii::$app->settings->apihost;
        $this->key = Yii::$app->settings->apikey;
    }

    /**
     * @return ResponseCommon
     */
    public function getResponse()
    {
        return $this->responseModel;
    }

    /**
     * @param integer $reportId
     * @return bool
     */
    public function sendReport($reportId)
    {
        $this->endpoint = 'v1/report';

        $requestModel = new RequestReport();
        if (!$requestModel->prepare($reportId)) {
            return false;
        }
        $this->body = $requestModel->toJson();
        $this->responseModel = new ResponseCommon();
        return $this->makeRequest();
    }

    /**
     * @param Command $command
     * @return bool
     */
    public function sendCommandResult(Command $command)
    {
        $this->endpoint = 'v1/command';

        $requestModel = new RequestCommand();
        if (!$requestModel->prepare($command)) {
            return false;
        }
        $this->body = $requestModel->toJson();
        $this->responseModel = new ResponseCommon();
        return $this->makeRequest();
    }



    public function sendRegister()
    {
        $this->endpoint = 'v1/register';

        $requestModel = new RequestRegister();
        if (!$requestModel->prepare()) {
            return false;
        }
        $this->body = $requestModel->toJson();
        $this->responseModel = new ResponseCommon();
        return $this->makeRequest();
    }



    /**
     * @return bool
     */
    private function makeRequest()
    {
        var_dump($this->endpoint);
        var_dump($this->key);
        var_dump($this->body);

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

        if (false === $response) {
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
        var_dump($response);
        $this->responseModel->load(['Response' => json_decode($response, true)]);
        return $this->responseModel->validate() && $this->responseModel->isSuccess();
    }


    /**
     *  run next command recursive execution
     */
    public function nextCommand()
    {
        $data = $this->responseModel->getResponseData();
        $nextCommand = $data->getNextCommand();

        if (null !== $nextCommand) {
            // run recursive command execution
            Commander::runRecursion($nextCommand);
        }
    }

}