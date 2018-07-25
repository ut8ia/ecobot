<?php

namespace common\models;

use common\services\commander\models\Command;
use Yii;

/**
 * This is the model class for table "commands".
 *
 * @property int $id
 * @property string $uid
 * @property string $type
 * @property string $command
 * @property string $payload
 * @property string $result
 * @property string $received
 * @property string $sent
 */
class Commands extends \yii\db\ActiveRecord
{

    const TYPE_INTERNAL = 'internal';
    const TYPE_SHELL = 'shell';
    const TYPE_EVENT = 'event';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'commands';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'command'], 'required'],
            [['type'], 'string'],
            [['uid'], 'string', 'max' => 32],
            [['received', 'sent'], 'safe'],
            [['command'], 'string', 'max' => 255],
            [['result'], 'string', 'max' => 2048],
            [['payload'], 'string', 'max' => 2048],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'uid' => Yii::t('app', 'UID'),
            'type' => Yii::t('app', 'Type'),
            'command' => Yii::t('app', 'Command'),
            'payload' => Yii::t('app', 'Payload'),
            'result' => Yii::t('app', 'Result'),
            'received' => Yii::t('app', 'Received'),
            'sent' => Yii::t('app', 'Sent'),
        ];
    }


    // do not save command with same uid
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            if ($insert) {
                $found = Commands::findOne(['uid' => $this->uid]);
                if ($found) {
                    return false;
                }
            }
            return true;
        }
        return false;
    }


}
