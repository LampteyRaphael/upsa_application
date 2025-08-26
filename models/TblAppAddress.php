<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_app_address".
 *
 * @property int $id
 * @property string $address
 * @property string $city
 * @property int $country
 * @property string|null $voters_id
 * @property int $voters_id_type
 * @property string|null $gps
 * @property string|null $email
 * @property string|null $telephone_number
 *
 * @property TblApp[] $tblApps
 * @property TblCountry $country0
 * @property TblVotersType $votersIdType
 */
class TblAppAddress extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_app_address';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['address', 'city', 'country','email', 'voters_id_type', 'telephone_number', 'voters_id','osn_id'], 'required'],
            [['voters_id_type','osn_id'], 'integer'],
            [['country'],'string'],
            [['address', 'city', 'email'], 'string', 'max' => 255],
            [['voters_id'],'string','max'=>20],
            [['email'],'email'],
            [['email','osn_id'],'unique'],
            [['telephone_number'],'unique'],
            [['voters_id', 'telephone_number'], 'string', 'max' => 50],
            [['gps'], 'string', 'max' => 100],
            // [['country'], 'exist', 'skipOnError' => true, 'targetClass' => TblCountry::className(), 'targetAttribute' => ['country' => 'id']],
            [['voters_id_type'], 'exist', 'skipOnError' => true, 'targetClass' => TblVotersType::className(), 'targetAttribute' => ['voters_id_type' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'address' => 'Address',
            'city' => 'City',
            'country' => 'Country',
            'voters_id' => 'ID Number',
            'voters_id_type' => 'ID Type',
            'gps' => 'GPS',
            'email' => 'Email',
            'telephone_number' => 'Telephone Number',
        ];
    }

    /**
     * Gets query for [[TblApps]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblApps()
    {
        return $this->hasMany(TblApp::className(), ['personal_address_id' => 'id']);
    }

    /**
     * Gets query for [[Country0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCountry0()
    {
        return $this->hasOne(TblCountry::className(), ['id' => 'country']);
    }

    /**
     * Gets query for [[VotersIdType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVotersIdType()
    {
        return $this->hasOne(TblVotersType::className(), ['id' => 'voters_id_type']);
    }
}
