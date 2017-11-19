<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "parameters".
 *
 * @property string $id
 * @property string $type
 * @property int $value
 * @property string $report_id
 */
class Parameters extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parameters';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'value', 'report_id'], 'required'],
            [['type'], 'string'],
            [['value', 'report_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'value' => Yii::t('app', 'Value'),
            'report_id' => Yii::t('app', 'Report ID'),
        ];
    }
}
