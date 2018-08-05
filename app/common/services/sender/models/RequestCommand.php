<?php

namespace common\services\sender\models;

use common\services\sender\models\data\RequestCommandData;

/**
 * Class RequestCommand
 * @package common\services\sender\models
 * @property array $data;
 * @property string $hash
 */
class RequestCommand extends RequestAbstract
{


    /**
     * @param $reportId
     * @return bool
     */
    public function prepare($reportId)
    {

        $dataModel = new RequestCommandData();
        $dataModel->prepare($reportId);
        if (!$dataModel->validate()) {
            return false;
        }
        $this->data = $dataModel->toArray();
        $this->makeHash($dataModel->toJson());
        return true;
    }


}