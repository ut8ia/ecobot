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

    const TYPE_TEMPERATURE = 'temperature';
    const TYPE_HUMIDITY = 'humidity';
    const TYPE_DUST10 = 'dust10';
    const TYPE_DUST25 = 'dust25';
    const TYPE_GAS = 'gas';

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


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReport()
    {
        return $this->hasOne(Reports::class, ['id' => 'report_id']);
    }


    /**
     * @param $type
     * @param $value
     * @return bool
     */
    public static function addRecord($type, $value)
    {
        $param = new Parameters();
        $param->type = $type;
        $param->value = $value;
        $param->report_id = Reports::findLastId();
        return $param->save();
    }


    /**
     * @param string $parameterType
     * @return bool
     */
    public static function checkParameter($parameterType)
    {
        $parameter = Parameters::find()
            ->where(['report_id' => Reports::findLastId()])
            ->andWhere(['type' => $parameterType])
            ->one();

        return (null !== $parameter);
    }

}
