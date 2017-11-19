<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reports".
 *
 * @property string $id
 * @property string $started
 * @property string $sent
 */
class Reports extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reports';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['started', 'sent'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'started' => Yii::t('app', 'Started'),
            'sent' => Yii::t('app', 'Sent'),
        ];
    }
}
