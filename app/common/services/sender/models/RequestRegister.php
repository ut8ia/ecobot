<?php

namespace common\services\sender\models;

use common\services\sender\models\data\RequestRegisterData;

class RequestRegister extends RequestAbstract
{

    /**
     * @param $reportId
     * @return bool
     */
    public function prepare($nullArgument = null)
    {

        $dataModel = new RequestRegisterData();
        $dataModel->prepare();
        if (!$dataModel->validate()) {
            return false;
        }
        $this->data = $dataModel->toArray();
        $this->makeHash($dataModel->toJson());
        return true;
    }

}