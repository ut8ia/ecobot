<?php


namespace common\services\commander\executions\workers;

use Yii;

/**
 * Class MigrateNew
 * @package common\services\commander\executions\workers
 */
class ApplySettings extends WorkerAbstract
{

    public function run()
    {
        $settings = json_decode($this->command->payload);
        if (empty($settings)) {
            $this->_result = 'decoded settings array is empty';
        }

        $c = Yii::$app->settings->reloadStoredSettings($settings);

        Yii::$app->settings->refresh();

        $this->_result = 'settings applied total :' . $c;
    }

}