<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TblStudRegistYear;

/**
 * TblStudRegistYearSearch represents the model behind the search form of `common\models\TblStudRegistYear`.
 */
class TblStudRegistYearSearch extends TblStudRegistYear
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'stud_acadamic_year_id', 'semester', 'status'], 'integer'],
            [['date'], 'safe'],
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
        $query = TblStudRegistYear::find();

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
            'id' => $this->id,
            'stud_acadamic_year_id' => $this->stud_acadamic_year_id,
            'date' => $this->date,
            'semester' => $this->semester,
            'status' => $this->status,
        ]);

        return $dataProvider;
    }
}
