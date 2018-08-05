<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property string $name
 * @property string $value
 * @property string $values
 * @property string $type
 * @property string $access
 * @property int $min
 * @property int $max
 * @property int $order
 * @property string $description
 */
class Settings extends \yii\db\ActiveRecord
{


    const TYPE_STRING = 'string';
    const TYPE_INTEGER = 'integer';
    const TYPE_FLOAT = 'float';
    const TYPE_ARRAY = 'array';
    const TYPE_BOOL = 'bool';


    const SETTING_EXT_PERFORMER_NAMESPACE = 'extPerformerNamespace';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['type', 'access'], 'string'],
            [['min', 'max', 'order'], 'integer'],
            [['name'], 'string', 'max' => 32],
            [['value', 'values', 'description'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Name'),
            'value' => Yii::t('app', 'Value'),
            'values' => Yii::t('app', 'Values'),
            'type' => Yii::t('app', 'Type'),
            'access' => Yii::t('app', 'Access'),
            'min' => Yii::t('app', 'Min'),
            'max' => Yii::t('app', 'Max'),
            'order' => Yii::t('app', 'Order'),
            'description' => Yii::t('app', 'Description'),
        ];
    }
}
