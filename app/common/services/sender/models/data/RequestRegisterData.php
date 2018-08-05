<?php

namespace common\services\sender\models\data;

use common\helpers\DataSourceHelper;
use common\services\commander\models\Command;
use Yii;
use yii\base\Model;

/**
 * Class RequestCommandData
 * @package common\services\sender\models\data
 *
 * @property string $serial
 * @property string $version
 */
class RequestRegisterData extends Model
{

    public $serial;
    public $version;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['serial', 'version'], 'required'],
        ];
    }

    /**
     * @param Command $command
     */
    public function prepare()
    {
        $this->serial = DataSourceHelper::getDeviceSerial();
        $this->version = Yii::$app->settings->version;
    }

    /**
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->toArray(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}