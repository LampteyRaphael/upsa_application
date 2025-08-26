<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_app".
 *
 * @property int $id
 * @property int $personal_details_id
 * @property int $personal_address_id
 * @property int|null $personal_education_id
 * @property int|null $personal_employment_id
 * @property int|null $personal_document_id
 * @property int|null $application_type
 * @property int|null $program_id
 * @property int $status
 * @property int|null $app_id
 * @property string|null $date
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property TblAppTypeCategory $applicationType
 * @property TblAppAddress $personalAddress
 * @property TblAppPersDetails $personalDetails
 * @property TblAppDocument $personalDocument
 * @property TblAppEduBg $personalEducation
 * @property TblAppEmpDetails $personalEmployment
 * @property TblAppProgram $program
 * @property TblAppStatus $status0
 */
class TblApp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_app';
    }


    // [['username'], 'unique', 'on'=>'update', 'when' => function($model){
    //     return $model->isAttributeChanged('username')
    // }],
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['personal_details_id', 'personal_address_id', 'status','osn_id'], 'required'],
            [['personal_details_id', 'personal_address_id', 'personal_education_id', 'personal_employment_id', 'personal_document_id', 'application_type', 'program_id', 'status', 'app_id','sms_1','sms_2','academic_year'], 'integer'],
            [['date', 'created_at', 'updated_at'], 'safe'],
            [['osn_id'], 'unique'],
            [['personal_details_id'], 'unique','on'=>'update', 'when' => function($model){
                return $model->isAttributeChanged('personal_details_id');
            }],

            [['personal_address_id'], 'unique','on'=>'update', 'when' => function($model){
                return $model->isAttributeChanged('personal_address_id');
            }],
            [['personal_employment_id'], 'unique','on'=>'update', 'when' => function($model){
                return $model->isAttributeChanged('personal_employment_id');
            }],
            [['personal_document_id'], 'unique','on'=>'update', 'when' => function($model){
                return $model->isAttributeChangwed('personal_document_id');
            }],
            [['personal_education_id'], 'unique','on'=>'update', 'when' => function($model){
                return $model->isAttributeChanged('personal_education_id');
            }],


            [['application_type'], 'exist', 'skipOnError' => true, 'targetClass' => TblAppTypeCategory::className(), 'targetAttribute' => ['application_type' => 'id']],
            [['personal_address_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblAppAddress::className(), 'targetAttribute' => ['personal_address_id' => 'id']],
            [['personal_details_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblAppPersDetails::className(), 'targetAttribute' => ['personal_details_id' => 'id']],
            [['personal_document_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblAppPersDetails::className(), 'targetAttribute' => ['personal_document_id' => 'id']],
            [['personal_education_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblAppEduBg::className(), 'targetAttribute' => ['personal_education_id' => 'id']],
            [['personal_employment_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblAppEmpDetails::className(), 'targetAttribute' => ['personal_employment_id' => 'id']],
            [['academic_year'], 'exist', 'skipOnError' => true, 'targetClass' => TblAcademicYear::className(), 'targetAttribute' => ['academic_year' => 'id']],
            [['program_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblAppProgram::className(), 'targetAttribute' => ['program_id' => 'id']],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => TblAppStatus::className(), 'targetAttribute' => ['status' => 'id']],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'personal_details_id' => 'Personal Details ID',
            'personal_address_id' => 'Personal Address ID',
            'personal_education_id' => 'Personal Education ID',
            'personal_employment_id' => 'Personal Employment ID',
            'personal_document_id' => 'Personal Document ID',
            'application_type' => 'Application Type',
            'program_id' => 'Program ID',
            'status' => 'Status',
            'app_id' => 'App',
            'date' => 'Date',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getAcademicYear()
    {
        return $this->hasOne(TblAcademicYear::className(), ['id' => 'academic_year']);
    }
    /**
     * Gets query for [[ApplicationType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApplicationType()
    {
        return $this->hasOne(TblAppTypeCategory::className(), ['id' => 'application_type']);
    }

    /**
     * Gets query for [[PersonalAddress]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonalAddress()
    {
        return $this->hasOne(TblAppAddress::className(), ['id' => 'personal_address_id']);
    }

    /**
     * Gets query for [[PersonalDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonalDetails()
    {
        return $this->hasOne(TblAppPersDetails::className(), ['id' => 'personal_details_id']);
    }

    /**
     * Gets query for [[PersonalDocument]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonalDocument()
    {
        return $this->hasOne(TblAppDocument::className(), ['id' => 'personal_document_id']);
    }

    /**
     * Gets query for [[PersonalEducation]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonalEducation()
    {
        return $this->hasOne(TblAppEduBg::className(), ['id' => 'personal_education_id']);
    }

    /**
     * Gets query for [[PersonalEmployment]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonalEmployment()
    {
        return $this->hasOne(TblAppEmpDetails::className(), ['id' => 'personal_employment_id']);
    }

    /**
     * Gets query for [[Program]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProgram()
    {
        return $this->hasOne(TblAppProgram::className(), ['id' => 'program_id']);
    }

    /**
     * Gets query for [[Status0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus0()
    {
        return $this->hasOne(TblAppStatus::className(), ['id' => 'status']);
    }


    public function getFullName()
    {
        return   ($this->personalDetails->title0->name??'') . ' ' . ($this->personalDetails->first_name??'') . ' ' .  ($this->personalDetails->middle_name??''). ' ' . ($this->personalDetails->last_name??'');
    }
    

}




