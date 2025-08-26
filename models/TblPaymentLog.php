<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_payment_log".
 *
 * @property int $id
 * @property int $payment_id
 * @property int $amount
 * @property string $reciept_no
 *
 * @property TblPayments $payment
 */
class TblPaymentLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_payment_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['payment_id', 'amount', 'reciept_no','user_id'], 'required'],
            [['payment_id', 'amount','user_id'], 'integer'],
            [['reciept_no'], 'string', 'max' => 100],
            [['payment_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblPayments::className(), 'targetAttribute' => ['payment_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'payment_id' => 'Payment',
            'amount' => 'Amount',
            'reciept_no' => 'Reciept No',
            'user_id' => 'Auth User',
        ];
    }

    /**
     * Gets query for [[Payment]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPayment()
    {
        return $this->hasOne(TblPayments::className(), ['id' => 'payment_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
