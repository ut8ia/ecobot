<?php

namespace common\services\sender\models;

use Yii;
use yii\base\Model;

/**
 * Class RequestAbstract
 * @package common\services\sender\models
 * @property array $data
 * @property string $hash
 */
abstract class RequestAbstract extends Model
{

    public $data;
    public $hash;


    /**
     * @param mixed $argument
     * @return mixed
     */
    abstract public function prepare($argument);

    /**
     * @param string $data
     */
    protected function makeHash($data)
    {
        $this->hash = hash_hmac('md5', $data, Yii::$app->settings->hashkey);
    }

    /**
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->toArray(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}