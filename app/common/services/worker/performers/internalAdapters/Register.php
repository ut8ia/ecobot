<?php

namespace common\services\worker\performers\internalAdapters;

use common\helpers\RegistrationHelper;

use Yii;

/**
 * Class Register
 * @package common\services\worker\performers\internalAdapters
 */
class Register extends InternalAdapterAbstract
{


    public function run()
    {
        $this->setProgress();

        RegistrationHelper::registerMe();
        $success = Yii::$app->params['apikey'] !== Yii::$app->settings->apikey;

        if ($success) {
           $this->setDone();
        }
        else{
            $this->setNew();
        }

    }

}