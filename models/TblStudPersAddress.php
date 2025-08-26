<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_stud_pers_address".
 *
 * @property int $id
 * @property string $address
 * @property string $city
 * @property string|null $voters_id
 * @property int $voters_id_type
 * @property string|null $gps
 * @property int $country
 * @property string|null $email
 * @property int $telephone_number
 *
 * @property TblStudDoc[] $tblStudDocs
 * @property TblCountry $country0
 * @property TblVotersType $votersIdType
 */
class TblStudPersAddress extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_stud_pers_address';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['address', 'city', 'voters_id_type', 'country', 'telephone_number'], 'required'],
            [['voters_id_type', 'country', 'telephone_number'], 'integer'],
            [['address', 'city', 'email'], 'string', 'max' => 255],
            [['voters_id'], 'string', 'max' => 20],
            [['gps'], 'string', 'max' => 50],
            [['telephone_number'], 'unique'],
            [['email','voters_id'], 'unique'],
            [['country'], 'exist', 'skipOnError' => true, 'targetClass' => TblCountry::className(), 'targetAttribute' => ['country' => 'id']],
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
            'voters_id' => 'Voters ID',
            'voters_id_type' => 'Voters Id Type',
            'gps' => 'Gps',
            'country' => 'Country',
            'email' => 'Email',
            'telephone_number' => 'Telephone Number',
        ];
    }

    /**
     * Gets query for [[TblStudDocs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblStudDocs()
    {
        return $this->hasMany(TblStudDoc::className(), ['stud_per_id' => 'id']);
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
