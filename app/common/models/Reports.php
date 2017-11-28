<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reports".
 *
 * @property integer $id
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


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParameters()
    {
        return $this->hasMany(Parameters::class, ['report_id' => 'id']);
    }

    /**
     * @return Reports
     */
    public static function create()
    {
        $report = new Reports();
        $report->save();
        return $report;
    }

    /**
     * @return array|null|\yii\db\ActiveRecord
     */
    public static function findLast()
    {
        return Reports::find()
            ->orderBy(['started' => SORT_DESC])
            ->one();
    }

    /**
     * @return int
     */
    public static function findLastId()
    {
        $report = self::findLast();
        if ($report) {
            return $report->id;
        }
    }

}
