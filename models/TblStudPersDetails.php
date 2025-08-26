<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_stud_pers_details".
 *
 * @property int $id
 * @property string $last_name
 * @property int $title
 * @property string $first_name
 * @property string|null $middle_name
 * @property string $gender
 * @property string|null $date_of_birth
 * @property string $nationality
 * @property string $contact_person
 * @property string $contact_number
 * @property string|null $photo
 * @property string|null $date_apply
 * @property string $created_at
 * @property string $updated_at
 *
 * @property TblStud[] $tblStuds
 * @property TblTitleTb $title0
 */
class TblStudPersDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_stud_pers_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['last_name', 'title', 'first_name', 'gender', 'nationality', 'contact_person', 'contact_number'], 'required'],
            [['title'], 'integer'],
            [['date_of_birth', 'date_apply', 'created_at', 'updated_at'], 'safe'],
            [['last_name', 'first_name', 'middle_name', 'nationality', 'photo'], 'string', 'max' => 255],
            [['gender'], 'string', 'max' => 50],
            [['contact_person'], 'string', 'max' => 100],
            [['contact_number'], 'string', 'max' => 20],
            [['title'], 'exist', 'skipOnError' => true, 'targetClass' => TblTitleTb::className(), 'targetAttribute' => ['title' => 'id']],
            [['nationality'], 'exist', 'skipOnError' => true, 'targetClass' => TblCountry::className(), 'targetAttribute' => ['nationality' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'last_name' => 'Last Name',
            'title' => 'Title',
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'gender' => 'Gender',
            'date_of_birth' => 'Date Of Birth',
            'nationality' => 'Nationality',
            'contact_person' => 'Contact Person',
            'contact_number' => 'Contact Number',
            'photo' => 'Photo',
            'date_apply' => 'Date Apply',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[TblStuds]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblStuds()
    {
        return $this->hasMany(TblStud::className(), ['personal_details_id' => 'id']);
    }

    public function getCountry()
    {
        return $this->hasMany(TblCountry::className(), ['nationality' => 'id']);
    }

    /**
     * Gets query for [[Title0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTitle0()
    {
        return $this->hasOne(TblTitleTb::className(), ['id' => 'title']);
    }
}
