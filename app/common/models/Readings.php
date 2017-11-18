<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "readings".
 *
 * @property string $type
 * @property int $value
 * @property string $make
 * @property string $send
 */
class Readings extends \yii\db\ActiveRecord
{

    const TYPE_TEMPERATURE = 'temperature';
    const TYPE_HUMIDITY = 'humidity';
    const TYPE_DUST = 'dust';
    const TYPE_CO2 = 'co2';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'readings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'value'], 'required'],
            [['value'], 'safe'],
            [['type'], 'string'],
            [['make', 'send'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'type' => Yii::t('app', 'Type'),
            'value' => Yii::t('app', 'Value'),
            'make' => Yii::t('app', 'Make'),
            'send' => Yii::t('app', 'Send'),
        ];
    }


    /**
     * @param $type
     * @param $value
     * @return string
     */
    public static function add($type, $value)
    {
        $record = new Readings();
        $record->type = $type;
        $record->value = $value;
        $record->save();
        unset($record);

//        return $record->id;
    }

}
