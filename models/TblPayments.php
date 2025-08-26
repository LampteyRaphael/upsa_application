<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_payments".
 *
 * @property int $id
 * @property float $amount
 * @property string $receipt_no
 * @property float|null $balance
 * @property int $user_id
 * @property int $admission_id
 * @property string $dates
 * @property int $status
 * @property string $created_at
 * @property string|null $updated_at
 *
 * @property TblAppAdmission $admission
 * @property TblPaymentStatus $status0
 * @property TblUser $user
 */
class TblPayments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_payments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['amount', 'receipt_no', 'user_id', 'admission_id', 'dates', 'status'], 'required'],
            [['amount', 'balance'], 'number'],
            [['user_id', 'admission_id', 'status'], 'integer'],
            [['dates', 'created_at', 'updated_at'], 'safe'],
            [['receipt_no'], 'string', 'max' => 40],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['admission_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblAppAdmission::className(), 'targetAttribute' => ['admission_id' => 'id']],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => TblPaymentStatus::className(), 'targetAttribute' => ['status' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'amount' => 'Amount',
            'receipt_no' => 'Receipt No',
            'balance' => 'Balance',
            'user_id' => 'User ID',
            'admission_id' => 'Admission ID',
            'dates' => 'Dates',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Admission]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAdmission()
    {
        return $this->hasOne(TblAppAdmission::className(), ['id' => 'admission_id']);
    }

    /**
     * Gets query for [[Status0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus0()
    {
        return $this->hasOne(TblPaymentStatus::className(), ['id' => 'status']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
