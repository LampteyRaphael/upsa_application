<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblTransaction;

/**
 * TblTransactionSearch represents the model behind the search form of `common\models\TblTransaction`.
 */
class TblTransactionSearch extends TblTransaction
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['transaction_id', 'user_id', 'txn_statusCode'], 'integer'],
            [['txn_ref', 'txn_amt', 'txn_currency', 'txn_sc', 'txn_sc_msg', 'txn_payLink', 'txn_otherInfo', 'txn_number', 'txn_maskedInstr', 'txn_cref', 'txn_sess', 'text', 'txn_payReference', 'txn_payScheme', 'txn_payFluidReference', 'txn_signature', 'txn_clientReference', 'created_at', 'updated_at'], 'safe'],
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
        $query = TblTransaction::find();

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

        $query->joinWith(['user']);

        // grid filtering conditions
        $query->andFilterWhere([
            'transaction_id' => $this->transaction_id,
            // 'user_id' => $this->user_id,
            'txn_statusCode' => $this->txn_statusCode,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'tbl_user.username', $this->user_id])
            ->andFilterWhere(['like', 'txn_ref', $this->txn_ref])
            ->andFilterWhere(['like', 'txn_amt', $this->txn_amt])
            ->andFilterWhere(['like', 'txn_currency', $this->txn_currency])
            ->andFilterWhere(['like', 'txn_sc', $this->txn_sc])
            ->andFilterWhere(['like', 'txn_sc_msg', $this->txn_sc_msg])
            ->andFilterWhere(['like', 'txn_payLink', $this->txn_payLink])
            ->andFilterWhere(['like', 'txn_otherInfo', $this->txn_otherInfo])
            ->andFilterWhere(['like', 'txn_number', $this->txn_number])
            ->andFilterWhere(['like', 'txn_maskedInstr', $this->txn_maskedInstr])
            ->andFilterWhere(['like', 'txn_cref', $this->txn_cref])
            ->andFilterWhere(['like', 'txn_sess', $this->txn_sess])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'txn_payReference', $this->txn_payReference])
            ->andFilterWhere(['like', 'txn_payScheme', $this->txn_payScheme])
            ->andFilterWhere(['like', 'txn_payFluidReference', $this->txn_payFluidReference])
            ->andFilterWhere(['like', 'txn_signature', $this->txn_signature])
            ->andFilterWhere(['like', 'txn_clientReference', $this->txn_clientReference]);

        return $dataProvider;
    }
}
