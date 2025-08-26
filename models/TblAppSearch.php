<?php

namespace app\models;

use app\models\TblApp;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * TblAppSearch represents the model behind the search form of `backend\modules\application\models\TblApp`.
 */
class TblAppSearch extends TblApp
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'personal_education_id', 'personal_employment_id', 'personal_document_id'], 'integer'],
            [['date','status','personal_details_id','personal_address_id','program_id', 'created_at', 'updated_at'], 'safe'],
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
        $query = TblApp::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->joinWith(['status0','program','personalDetails','personalAddress']);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            // 'personal_details_id' => $this->personal_details_id,
            // 'personal_address_id' => $this->personal_address_id,
            'personal_education_id' => $this->personal_education_id,
            'personal_employment_id' => $this->personal_employment_id,
            'personal_document_id' => $this->personal_document_id,
            'application_type' => $this->application_type,
            // 'program_id' => $this->program_id,
            // 'status' => $this->status,
            // 'app_quali_id' => $this->app_quali_id,
            'date' => $this->date,
            // 'account_id' => $this->account_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'tbl_app_pers_details.first_name', $this->personal_details_id])
            ->andFilterWhere(['like', 'tbl_app_address.email', $this->personal_address_id])
            ->andFilterWhere(['like', 'tbl_app_status.id', $this->status])
            ->andFilterWhere(['like', 'tbl_app_program.id', $this->program_id]);
            // ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}
