<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_country".
 *
 * @property int $id
 * @property string|null $country
 * @property float|null $amount
 * @property string|null $currency
 * @property string|null $code
 * @property string|null $symbol
 */
class TblCountry extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_country';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['amount'], 'number'],
            [['country', 'currency', 'code', 'symbol'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country' => 'Country',
            'amount' => 'Amount',
            'currency' => 'Currency',
            'code' => 'Code',
            'symbol' => 'Symbol',
        ];
    }


    public function getTblAppAddresses()
    {
        return $this->hasMany(TblAppAddress::className(), ['country' => 'id']);
    }

    /**
     * Gets query for [[TblStudPersAddresses]].
     *
     * @return \yii\db\ActiveQuery|TblStudPersAddressQuery
     */
    public function getTblStudPersAddresses()
    {
        return $this->hasMany(TblStudPersAddress::className(), ['country' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return TblCountryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TblCountryQuery(get_called_class());
    }
}