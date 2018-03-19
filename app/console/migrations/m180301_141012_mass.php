<?php

use yii\db\Schema;
use yii\db\Migration;

class m180301_141012_mass extends Migration
{
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('{{%settings}}',
            [
                'name' => Schema::TYPE_STRING . '(32) NOT NULL',
                'value' => Schema::TYPE_STRING . '(255) NOT NULL',
                'def' => Schema::TYPE_STRING . '(255) NOT NULL',
                'changed' => Schema::TYPE_TIMESTAMP . ' NOT NULL DEFAULT "0000-00-00 00:00:00"',
            ], $tableOptions);

    }

    public function safeDown()
    {
        $this->dropTable('{{%settings}}');
    }
}
