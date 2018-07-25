<?php

use yii\db\Schema;
use yii\db\Migration;

class m180301_141013_commands extends Migration
{
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('{{%commands}}',
            [
                'id' => Schema::TYPE_PK . '',
                'uid' => Schema::TYPE_STRING . '(32) NULL',
                'type' => "enum('internal','shell','event')" . ' NOT NULL',
                'command' => Schema::TYPE_STRING . '(255) NOT NULL',
                'payload' => Schema::TYPE_STRING . '(2048) NULL',
                'result' => Schema::TYPE_STRING . '(2048) NULL',
                'received' => Schema::TYPE_TIMESTAMP . ' NOT NULL DEFAULT CURRENT_TIMESTAMP',
                'sent' => Schema::TYPE_TIMESTAMP . ' NULL DEFAULT NULL',
            ], $tableOptions);

    }

    public function safeDown()
    {
        $this->dropTable('{{%commands}}');
    }
}
