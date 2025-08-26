<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_stud_employ_details".
 *
 * @property int $id
 * @property string|null $company_name
 * @property string|null $position
 * @property string|null $employer_address
 * @property string|null $employer_telephone_number
 * @property int $stud_per_id
 *
 * @property TblStudPersDetails $studPer
 */
class TblStudEmployDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_stud_employ_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['stud_per_id'], 'required'],
            [['stud_per_id'], 'integer'],
            [['stud_per_id'],'unique'],
            [['company_name', 'employer_address'], 'string', 'max' => 255],
            [['position'], 'string', 'max' => 200],
            [['employer_telephone_number'], 'string', 'max' => 20],
            [['stud_per_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblStudPersDetails::className(), 'targetAttribute' => ['stud_per_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_name' => 'Company Name',
            'position' => 'Position',
            'employer_address' => 'Employer Address',
            'employer_telephone_number' => 'Employer Telephone Number',
            'stud_per_id' => 'Stud Per ID',
        ];
    }

    /**
     * Gets query for [[StudPer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudPer()
    {
        return $this->hasOne(TblStudPersDetails::className(), ['id' => 'stud_per_id']);
    }
}
