<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_transaction".
 *
 * @property int $transaction_id
 * @property string|null $app_id
 * @property string|null $txn_ref
 * @property float|null $txn_amt
 * @property string|null $txn_currency
 * @property string|null $txn_sc
 * @property string|null $txn_sc_msg
 * @property string|null $txn_payLink
 * @property string|null $txn_otherInfo
 * @property string|null $txn_number
 * @property string|null $txn_maskedInstr
 * @property string|null $txn_cref
 * @property string|null $txn_sess
 * @property string|null $text
 * @property string|null $txn_payReference
 * @property string|null $txn_payScheme
 * @property string|null $txn_payFluidReference
 * @property string|null $txn_signature
 * @property int|null $txn_statusCode
 * @property string|null $txn_clientReference
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $user_id
 */
class TblTransaction extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_transaction';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['txn_amt'], 'number'],
            [['txn_signature'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['txn_ref', 'txn_sc', 'txn_sc_msg', 'txn_payLink', 'txn_otherInfo', 'txn_maskedInstr', 'txn_cref', 'txn_sess', 'text', 'txn_payReference', 'txn_payScheme', 'txn_payFluidReference', 'txn_clientReference'], 'string', 'max' => 255],
            [['txn_currency', 'txn_number'], 'string', 'max' => 45],
            // [['transaction_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblOsn::class, 'targetAttribute' => ['transaction_id' => 'id']],

        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'transaction_id' => 'Transaction ID',
            // 'app_id' => 'App ID',
            'txn_ref' => 'Txn Ref',
            'txn_amt' => 'Txn Amt',
            'txn_currency' => 'Txn Currency',
            'txn_sc' => 'Txn Sc',
            'txn_sc_msg' => 'Txn Sc Msg',
            'txn_payLink' => 'Txn Pay Link',
            'txn_otherInfo' => 'Txn Other Info',
            'txn_number' => 'Txn Number',
            'txn_maskedInstr' => 'Txn Masked Instr',
            'txn_cref' => 'Txn Cref',
            'txn_sess' => 'Txn Sess',
            'text' => 'Text',
            'txn_payReference' => 'Txn Pay Reference',
            'txn_payScheme' => 'Txn Pay Scheme',
            'txn_payFluidReference' => 'Txn Pay Fluid Reference',
            'txn_signature' => 'Txn Signature',
            'txn_statusCode' => 'Txn Status Code',
            'txn_clientReference' => 'Txn Client Reference',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
        ];
    }




    /**
     * Gets query for [[AcadamicYear]].
     *
     * @return \yii\db\ActiveQuery
     */

     public function getUser(){
        
        return $this->hasOne(TblOsn::className(), ['id' => 'transaction_id']);
    }
    


}
