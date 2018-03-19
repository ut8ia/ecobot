<?php

use yii\db\Schema;
use yii\db\Migration;

class m180301_140612_mass extends Migration
{
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('{{%readings}}',
            [
                'type' => "enum('temperature','humidity','dust','co2')" . ' NOT NULL',
                'value' => Schema::TYPE_STRING . '(128) NOT NULL',
                'make' => Schema::TYPE_TIMESTAMP . ' NOT NULL',
                'send' => Schema::TYPE_TIMESTAMP . '',
            ], $tableOptions);

    }

    public function safeDown()
    {
        $this->dropTable('{{%readings}}');
    }
}
