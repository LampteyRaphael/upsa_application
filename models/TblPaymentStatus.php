<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_payment_status".
 *
 * @property int $id
 * @property string $name
 *
 * @property TblPayments[] $tblPayments
 */
class TblPaymentStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_payment_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[TblPayments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblPayments()
    {
        return $this->hasMany(TblPayments::className(), ['status' => 'id']);
    }
}
