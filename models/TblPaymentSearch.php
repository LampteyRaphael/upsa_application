<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 * TblPaymentSearch represents the model behind the search form of `common\models\TblPayment`.
 */
class TblPaymentSearch extends TblPayments
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            // [[ ''], 'number'],
            [['receipt_no'], 'string'],
            [['dates', 'status', 'admission_id', 'amount','created_at', 'updated_at'], 'safe'],
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
        $query = TblPayments::find();

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

        $query->joinWith(['status0','admission']);
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'amount' => $this->amount,
            'receipt_no' => $this->receipt_no,
            'balance' => $this->balance,
            'user_id' => $this->user_id,
            // 'admission_id' => $this->admission_id,
            // 'program_id' => $this->program,
            'dates' => $this->dates,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

         $query->andFilterWhere(['like', 'tbl_app_admission.application_id', $this->admission_id]);
         $query->andFilterWhere(['like', 'tbl_payment_status.name', $this->status]);
        //  $query->andFilterWhere(['like', 'tbl_payments.amount', $this->amount]);

        return $dataProvider;
    }
}
