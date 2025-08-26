<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblOsn;

/**
 * TblOsnSearch represents the model behind the search form of `common\models\TblOsn`.
 */
class TblOsnSearch extends TblOsn
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'role_id'], 'integer'],
            [['osn_number', 'year', 'transaction_no', 'studOption', 'studentID', 'pin_code', 'username', 'email', 'phone_number', 'nationality', 'first_name', 'last_name', 'password_hash', 'auth_key', 'verification_token', 'created_at', 'updated_at', 'password'], 'safe'],
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
        $query = TblOsn::find();

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
            'status' => $this->status,
            'role_id' => $this->role_id,
            'year' => $this->year,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'osn_number', $this->osn_number])
            ->andFilterWhere(['like', 'transaction_no', $this->transaction_no])
            ->andFilterWhere(['like', 'studOption', $this->studOption])
            ->andFilterWhere(['like', 'studentID', $this->studentID])
            ->andFilterWhere(['like', 'pin_code', $this->pin_code])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone_number', $this->phone_number])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'verification_token', $this->verification_token])
            ->andFilterWhere(['like', 'password', $this->password]);

        return $dataProvider;
    }
}
