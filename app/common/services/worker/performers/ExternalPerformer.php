<?php

namespace common\services\worker\performers;

use common\models\Settings;
use common\services\worker\performers\internalAdapters\InternalAdapterAbstract;
use common\services\worker\performers\PerformerAbstract;

class ExternalPerformer extends PerformerAbstract
{

    public function run()
    {
        $adapter = $this->makeAdapter();
        $adapter->run();
    }


    /**
     * @return InternalAdapterAbstract
     */
    private function makeAdapter()
    {
        $nameSpace = Yii::$app->settings->{Settings::SETTING_EXT_PERFORMER_NAMESPACE};
        $className = $nameSpace . $this->_task->name;

        if (class_exists($className)) {
            $adapter = new $className($this->_task);
        } else {
            $adapter = new Unknown($this->_task);
        }

        return $adapter;
    }

}