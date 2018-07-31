<?php

namespace common\components\settings;


use common\models\Settings;
use yii\base\Component;
use Yii;

/**
 * Class SettingsComponent
 * @package common\components\settings
 * @property bool $protected
 * @property SettingsObject $settings
 */
class SettingsComponent extends Component
{


    private $settings;

    public $protected;

    public function init()
    {
        $this->settings = new SettingsObject();
        $this->makeConfig();

        parent::init();
    }


    public function refresh(){

        $this->settings = new SettingsObject();
        $this->makeConfig();

    }


    /**
     * PHP getter magic method
     *
     * params priority: 1 settings object (db); 2 params from config
     *
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        if (isset($this->settings->{$name})) {
            return $this->settings->{$name};
        } elseif (isset(Yii::$app->params[$name])) {
            return Yii::$app->params[$name];
        }

        return null;
    }

    /**
     * @param $settings
     * @return int
     */
    public function reloadStoredSettings($settings)
    {
        if ($this->protected) {
            return 0;
        }

        $this->cleanStoredSettings();

        $c = 0;
        foreach ($settings as $setting) {

            $newSetting = new Settings();
            $newSetting->name = $setting->name;
            $newSetting->value = $setting->value;
            $newSetting->values = $setting->values;
            $newSetting->type = $setting->type;
            $newSetting->access = $setting->access;
            $newSetting->min = $setting->min;
            $newSetting->max = $setting->max;
            $newSetting->order = $setting->order;
            $newSetting->description = $setting->description;

            if ($newSetting->save()) {
                $c++;
            }
        }

        return $c;

    }


    /**
     * populate settingsObject with properties
     */
    private function makeConfig()
    {

        $params = Settings::find()->all();
        /**
         * @var Settings $param
         */
        foreach ($params as $param) {
            $this->settings->{$param->name} = $this->adjustType($param->type, $param->value);
        }

    }

    /**
     * @param string $type
     * @param string $value
     * @return bool|float|int|mixed|string
     */
    private function adjustType($type, $value)
    {
        switch ($type) {
            case Settings::TYPE_STRING:
                return (string)$value;
                break;
            case Settings::TYPE_INTEGER:
                return (int)$value;
                break;
            case Settings::TYPE_FLOAT:
                return (float)$value;
                break;
            case Settings::TYPE_ARRAY:
                return json_decode($value);
                break;
            case Settings::TYPE_BOOL:
                return (bool)$value;
                break;
            default:
                return $value;
        }

    }

    /**
     *
     */
    private function cleanStoredSettings()
    {
        if ($this->protected) {
            return null;
        }

        Settings::deleteAll();
    }


}