<?php

use yii\db\Migration;

class m180301_141012_settings extends Migration
{
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('{{%settings}}',
            [
                'name' => $this->string(32)->unique()->notNull(),
                'value' => $this->string(255),
                'values' => $this->string(255),
                'type' => "enum('string','integer','float','array','bool')" . ' NOT NULL',
                'access' => "enum('public','protected','private') NOT NULL default 'private'",
                'min'=>$this->integer()->null(),
                'max'=>$this->integer()->null(),
                'order'=>$this->integer(2)->null(),
                'description'=>$this->string(255)->null()

            ], $tableOptions);

        $this->addPrimaryKey('name-pk','{{%settings}}','name');
    }

    public function safeDown()
    {
        $this->dropTable('{{%settings}}');
    }
}
