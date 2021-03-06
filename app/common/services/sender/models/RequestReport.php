<?php

namespace common\services\sender\models;

use common\services\sender\models\data\RequestReportData;

class RequestReport extends RequestAbstract
{

    /**
     * @param $reportId
     * @return bool
     */
    public function prepare($reportId)
    {

        $dataModel = new RequestReportData();
        $dataModel->prepare($reportId);
        if (!$dataModel->validate()) {
            return false;
        }
        $this->data = $dataModel->toArray();
        $this->makeHash($dataModel->toJson());
        return true;
    }

}