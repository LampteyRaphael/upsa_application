<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
/**
 * TblAppAdmissionSearch represents the model behind the search form of `backend\modules\admission\models\TblAppAdmission`.
 */
class TblAppAdmissionSearch extends TblAppAdmission
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'status', 'application_id'], 'integer'],
            [['doa', 'doc', 'created_at', 'updated_at','accadamin_year_id'], 'safe'],
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
        $query = TblAppAdmission::find();

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

        // $query->joinWith(['accadaminYear']);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'status' => $this->status,
            // 'doa' => $this->doa,
            // 'doc' => $this->doc,
            'application_id' => $this->application_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            // 'accadamin_year_id' => $this->accadamin_year_id,
        ]);

        $query->andFilterWhere(['like', 'tbl_acadamic_year.doa', $this->accadamin_year_id]);

        return $dataProvider;
    }
}
