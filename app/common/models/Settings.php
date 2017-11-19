<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property string $name
 * @property string $value
 * @property string $def
 * @property string $changed
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'value', 'def'], 'required'],
            [['changed'], 'safe'],
            [['name'], 'string', 'max' => 32],
            [['value', 'def'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Name'),
            'value' => Yii::t('app', 'Value'),
            'def' => Yii::t('app', 'Default'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }
}
