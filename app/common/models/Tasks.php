<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $uid
 * @property string $status
 * @property string $type
 * @property string $name
 * @property string $payload
 * @property string $result
 * @property string $apply_time
 * @property string $received
 * @property string $updated
 */
class Tasks extends \yii\db\ActiveRecord
{

    const STATUS_NEW = 'new';
    const STATUS_PROGRESS = 'progress';
    const STATUS_REJECTED = 'rejected';
    const STATUS_DONE = 'done';

    const TYPE_INTERNAL = 'internal';
    const TYPE_EXTERNAL = 'external';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'name', 'type'], 'required'],
            [['status', 'type'], 'string'],
            [['apply_time', 'received', 'updated'], 'safe'],
            [['uid', 'name'], 'string', 'max' => 32],
            [['payload', 'result'], 'string', 'max' => 2048],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'uid' => Yii::t('app', 'Uid'),
            'status' => Yii::t('app', 'Status'),
            'type' => Yii::t('app', 'Type'),
            'name' => Yii::t('app', 'Name'),
            'payload' => Yii::t('app', 'Payload'),
            'result' => Yii::t('app', 'Result'),
            'apply_time' => Yii::t('app', 'Apply time'),
            'received' => Yii::t('app', 'Received'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }
}
