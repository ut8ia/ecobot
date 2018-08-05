<?php

use yii\db\Schema;
use yii\db\Migration;

class m180301_135812_parameters extends Migration
{
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('{{%parameters}}',
            [
                'id' => Schema::TYPE_PK . '',
                'type' => "enum('temperature','humidity','dust10','dust25','gas')" . ' NOT NULL',
                'value' => Schema::TYPE_INTEGER . '(10) NOT NULL',
                'report_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            ], $tableOptions);

        $this->addForeignKey('fk_parameters_report_id', '{{%parameters}}', 'report_id', '{{%reports}}', 'id', 'cascade', 'cascade');


    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_parameters_report_id', '{{%parameters}}');
        $this->dropTable('{{%parameters}}');
    }
}
