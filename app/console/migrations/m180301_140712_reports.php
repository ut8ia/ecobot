<?php

use yii\db\Schema;
use yii\db\Migration;

class m180301_140712_reports extends Migration
{
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('{{%reports}}',
            [
                'id' => Schema::TYPE_PK . '',
                'started' => Schema::TYPE_TIMESTAMP . ' NOT NULL DEFAULT CURRENT_TIMESTAMP',
                'sent' => Schema::TYPE_TIMESTAMP . ' NULL',
            ], $tableOptions);

    }

    public function safeDown()
    {
        $this->dropTable('{{%reports}}');
    }
}
