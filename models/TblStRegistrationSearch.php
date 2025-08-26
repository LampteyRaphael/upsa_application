<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblStRegistration;

/**
 * TblStRegistrationSearch represents the model behind the search form of `common\models\TblStRegistration`.
 */
class TblStRegistrationSearch extends TblStRegistration
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'stud_Id', 'program_id', 'level_id', 'acadamic_year', 'status', 'semester', 'section_id', 'courese_id'], 'integer'],
            [['date_o_regis', 'created_at', 'updated_at'], 'safe'],
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
        $query = TblStRegistration::find();

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
            'stud_Id' => $this->stud_Id,
            'program_id' => $this->program_id,
            'level_id' => $this->level_id,
            'acadamic_year' => $this->acadamic_year,
            'status' => $this->status,
            'semester' => $this->semester,
            'section_id' => $this->section_id,
            'date_o_regis' => $this->date_o_regis,
            'courese_id' => $this->courese_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}
