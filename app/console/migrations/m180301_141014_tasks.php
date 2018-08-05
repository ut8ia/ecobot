<?php

use yii\db\Schema;
use yii\db\Migration;

class m180301_141014_tasks extends Migration
{
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('{{%tasks}}',
            [
                'id' => Schema::TYPE_PK . '',
                'uid' => Schema::TYPE_STRING . '(32) NULL',
                'status' => "enum('new','progress','rejected','done')" . ' NOT NULL',
                'type' => "enum('internal','external') NOT NULL DEFAULT 'internal' ",
                'name' => Schema::TYPE_STRING . '(32) NOT NULL',
                'payload' => Schema::TYPE_STRING . '(2048) NULL',
                'result' => Schema::TYPE_STRING . '(2048) NULL',
                'apply_time' => Schema::TYPE_TIMESTAMP . ' NULL',
                'received' => Schema::TYPE_TIMESTAMP . ' NOT NULL DEFAULT CURRENT_TIMESTAMP',
                'updated' => Schema::TYPE_TIMESTAMP . ' NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            ], $tableOptions);

    }

    public function safeDown()
    {
        $this->dropTable('{{%tasks}}');
    }
}
