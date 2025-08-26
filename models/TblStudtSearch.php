<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblStud;

/**
 * TblStudtSearch represents the model behind the search form of `backend\modules\students\models\TblStud`.
 */
class TblStudtSearch extends TblStud
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['dates','created_at','personal_details_id',  'personal_address_id', 'personal_education_id', 'personal_employment_id',  'personal_document_id', 'application_type', 'status', 'user_id', 'program_id', 'updated_at'], 'safe'],
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
        $query = TblStud::find();

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

        $query->joinWith(['personalDetails','program','status0','personalAddress','personalEducation']);


        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            // 'personal_details_id' => $this->personal_details_id,
            // 'personal_address_id' => $this->personal_address_id,
            // 'personal_education_id' => $this->personal_education_id,
            'personal_employment_id' => $this->personal_employment_id,
            'personal_document_id' => $this->personal_document_id,
            'application_type' => $this->application_type,
            // 'status' => $this->status,
            'user_id' => $this->user_id,
            // 'program_id' => $this->program_id,
            'dates' => $this->dates,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'tbl_stud_pers_details.last_name', $this->personal_details_id]);
        $query->andFilterWhere(['like', 'tbl_program.program_name', $this->program_id]);
        $query->andFilterWhere(['like', 'tbl_stud_status.name', $this->status]);
        $query->andFilterWhere(['like', 'tbl_stud_pers_address.telephone_number', $this->personal_address_id]);
        $query->andFilterWhere(['like', 'tbl_stud_edu_bg.institution', $this->personal_education_id]);
        // ->andFilterWhere(['like', 'tbl_app_program.id', $this->program_id]);

        return $dataProvider;
    }
}
