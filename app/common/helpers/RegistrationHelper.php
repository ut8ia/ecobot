<?php


namespace common\helpers;


use common\services\sender\Sender;

class RegistrationHelper
{


    public static function registerMe()
    {
        $sender = new Sender();

        if ($sender->sendRegister()) {
            $sender->nextCommand();
        }

    }


}