<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Settings;

/**
 * SettinsSearch represents the model behind the search form of `common\models\Settings`.
 */
class SettinsSearch extends Settings
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'value', 'values', 'type', 'access', 'description'], 'safe'],
            [['min', 'max', 'order'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Settings::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'min' => $this->min,
            'max' => $this->max,
            'order' => $this->order,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'value', $this->value])
            ->andFilterWhere(['like', 'values', $this->values])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'access', $this->access])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
