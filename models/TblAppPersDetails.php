<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_app_pers_details".
 *
 * @property int $id
 * @property int $title
 * @property string $last_name
 * @property string $first_name
 * @property string $middle_name
 * @property string $gender
 * @property string $date_of_birth
 * @property string $nationality
 * @property string $contact_person
 * @property string $contact_number
 * @property string $date_apply
 * @property int $osn_id
 * @property string $photo
 * @property string $created_at
 * @property string|null $updated_at
 *
 * @property TblApp[] $tblApps
 * @property TblAppDocument[] $tblAppDocuments
 * @property TblOsn $osn
 * @property TblTitleTb $title0
 * @property TblAppProgram[] $tblAppPrograms
 */
class TblAppPersDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_app_pers_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'last_name', 'first_name', 'gender', 'date_of_birth', 'nationality', 'nationality','contact_person', 'contact_number', 'date_apply','osn_id'], 'required'],
            [['title', 'osn_id'], 'integer'],
            // [['photo'],'file', 'skipOnEmpty' => true, 'on'=>'update', 'extensions' => 'png, jpg,jpeg'],
            [['date_of_birth', 'date_apply', 'created_at', 'updated_at'], 'safe'],
            [['last_name', 'first_name', 'middle_name', 'nationality', 'contact_person', 'photo'], 'string', 'max' => 200],
            [['gender'], 'string', 'max' => 20],
            // [['contact_number'], 'string', 'max' => 20],
            // [['contact_number'],'unique'],
            [['osn_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblOsn::className(), 'targetAttribute' => ['osn_id' => 'id']],
            [['title'], 'exist', 'skipOnError' => true, 'targetClass' => TblTitleTb::className(), 'targetAttribute' => ['title' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'last_name' => 'Last Name',
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'gender' => 'Gender',
            'date_of_birth' => 'Date Of Birth',
            'nationality' => 'Nationality',
            'contact_person' => 'Contact Person',
            'contact_number' => 'Contact Number',
            'date_apply' => 'Date Apply',
            'osn_id' => 'Osn ID',
            'photo' => 'Photo',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }


    public function getFull(){

        return  $this->first_name . ' '. $this->middle_name. '' . $this->last_name;
    }

    /**
     * Gets query for [[TblApps]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblApps()
    {
        return $this->hasMany(TblApp::className(), ['personal_details_id' => 'id']);
    }

    /**
     * Gets query for [[TblAppDocuments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblAppDocuments()
    {
        return $this->hasMany(TblAppDocument::className(), ['personalDetail_id' => 'id']);
    }

    /**
     * Gets query for [[Osn]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOsn()
    {
        return $this->hasOne(TblOsn::className(), ['id' => 'osn_id']);
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

    /**
     * Gets query for [[TblAppPrograms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblAppPrograms()
    {
        return $this->hasMany(TblAppProgram::className(), ['personalDetail_id' => 'id']);
    }
}
