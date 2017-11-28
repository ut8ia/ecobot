<?php

namespace common\helpers;


use common\models\Parameters;
use common\models\Reports;
use Yii;
use yii\base\BaseObject;

/**
 * Class ReportHelper
 * @package common\helpers
 */
class ReportBuilder extends BaseObject
{

    /** @var int $limit */
    public $limit = 62;

    private $labels = [];
    private $temperature = [];
    private $humidity = [];
    private $dust10 = [];
    private $dust25 = [];
    private $gas = [];

    /** @var array $reports */
    private $reports;

    const PARAM_TYPES = ['temperature', 'humidity', 'dust10', 'dust25', 'gas'];

    /**
     * @return int
     */
    public function makeReport()
    {
        $this->findReports();
        if (empty($this->reports)) {
            return 0;
        }
        return $this->processReports();
    }

    /** @return array */
    public function getLabels()
    {
        return $this->labels;
    }

    /** @return array */
    public function getTemperature()
    {
        return $this->temperature;
    }

    /** @return array */
    public function getHumidity()
    {
        return $this->humidity;
    }

    /** @return array */
    public function getDust25()
    {
        return $this->dust25;
    }

    /** @return array */
    public function getDust10()
    {
        return $this->dust10;
    }

    /** @return array */
    public function getGas()
    {
        return $this->gas;
    }

    /**
     * @return int
     */
    private function processReports()
    {
        $count = 0;
        /** @var $report Reports */
        foreach ($this->reports as $report) {
            $this->processParams($report);
            $this->labels[] = $report->started;
            $count++;
        }
        return $count;
    }

    /**
     * @param Reports $report
     */
    private function processParams(Reports $report)
    {

        $types = self::PARAM_TYPES;
        if (null !== $report->parameters) {
            /** @var $parameter Parameters */
            foreach ($report->parameters as $parameter) {
                $this->{$parameter->type}[] = $parameter->value;
                unset($types[$parameter->type]);
            }
        }

        $this->fillEmpty($types);
    }

    /**
     * @param array $names
     */
    private function fillEmpty($names = [])
    {
        foreach ($names as $name) {
            $this->$name[] = null;
        }
    }


    private function findReports()
    {
        $this->reports = Reports::find()
            ->with('parameters')
            ->limit($this->limit)
            ->orderBy(['id' => SORT_DESC])
            ->all();
    }

}