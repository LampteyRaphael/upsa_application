<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_stud".
 *
 * @property int $id
 * @property int|null $personal_details_id
 * @property int|null $personal_address_id
 * @property int|null $personal_education_id
 * @property int|null $personal_employment_id
 * @property int|null $personal_document_id
 * @property int|null $application_type
 * @property int|null $status
 * @property int|null $user_id
 * @property int|null $program_id
 * @property string|null $dates
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $accadamin_year_id
 *
 * @property TblAcademicYear $accadaminYear
 * @property TblStudDoc $personalDocument
 * @property TblStudEduBg $personalEducation
 * @property TblStudEmployDetails $personalEmployment
 * @property TblStudPersAddress $personalAddress
 * @property TblStudPersDetails $personalDetails
 * @property TblStudStatus $status0
 * @property TblProgram $program
 * @property TblStudQuali[] $tblStudQualis
 * @property TblStudsResult[] $tblStudsResults
 * @property TblStudsTranscript[] $tblStudsTranscripts
 */
class TblStud extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_stud';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['personal_details_id', 'personal_address_id', 'personal_education_id', 'personal_employment_id', 'personal_document_id', 'application_type', 'status', 'user_id', 'program_id', 'accadamin_year_id'], 'integer'],
            [['dates', 'created_at', 'updated_at'], 'safe'],
            [['accadamin_year_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblAcademicYear::className(), 'targetAttribute' => ['accadamin_year_id' => 'id']],
            [['personal_document_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblStudDoc::className(), 'targetAttribute' => ['personal_document_id' => 'id']],
            [['personal_education_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblStudEduBg::className(), 'targetAttribute' => ['personal_education_id' => 'id']],
            [['personal_employment_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblStudEmployDetails::className(), 'targetAttribute' => ['personal_employment_id' => 'id']],
            [['personal_address_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblStudPersAddress::className(), 'targetAttribute' => ['personal_address_id' => 'id']],
            [['personal_details_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblStudPersDetails::className(), 'targetAttribute' => ['personal_details_id' => 'id']],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => TblStudStatus::className(), 'targetAttribute' => ['status' => 'id']],
            [['program_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblProgram::className(), 'targetAttribute' => ['program_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblUser::className(), 'targetAttribute' => ['user_id' => 'id']],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'personal_details_id' => 'Personal Details',
            'personal_address_id' => 'Personal Address',
            'personal_education_id' => 'Personal Education',
            'personal_employment_id' => 'Personal Employment',
            'personal_document_id' => 'Personal Document',
            'application_type' => 'Application Type',
            'status' => 'Status',
            'user_id' => 'User',
            'program_id' => 'Program',
            'dates' => 'Dates',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'accadamin_year_id' => 'Accadamin Year',
        ];
    }

    /**
     * Gets query for [[AccadaminYear]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAccadaminYear()
    {
        return $this->hasOne(TblAcademicYear::className(), ['id' => 'accadamin_year_id']);
    }


    /** User Account */
    public function getUser()
    {
        return $this->hasOne(TblUser::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query for [[PersonalDocument]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonalDocument()
    {
        return $this->hasOne(TblStudDoc::className(), ['id' => 'personal_document_id']);
    }

    /**
     * Gets query for [[PersonalEducation]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonalEducation()
    {
        return $this->hasOne(TblStudEduBg::className(), ['id' => 'personal_education_id']);
    }

    /**
     * Gets query for [[PersonalEmployment]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonalEmployment()
    {
        return $this->hasOne(TblStudEmployDetails::className(), ['id' => 'personal_employment_id']);
    }

    /**
     * Gets query for [[PersonalAddress]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonalAddress()
    {
        return $this->hasOne(TblStudPersAddress::className(), ['id' => 'personal_address_id']);
    }

    /**
     * Gets query for [[PersonalDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonalDetails()
    {
        return $this->hasOne(TblStudPersDetails::className(), ['id' => 'personal_details_id']);
    }

    /**
     * Gets query for [[Status0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus0()
    {
        return $this->hasOne(TblStudStatus::className(), ['id' => 'status']);
    }

    /**
     * Gets query for [[Program]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProgram()
    {
        return $this->hasOne(TblProgram::className(), ['id' => 'program_id']);
    }

    /**
     * Gets query for [[TblStudQualis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblStudQualis()
    {
        return $this->hasMany(TblStudQuali::className(), ['students_id' => 'id']);
    }

    /**
     * Gets query for [[TblStudsResults]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblStudsResults()
    {
        return $this->hasMany(TblStudsResult::className(), ['student_id' => 'id']);
    }

    /**
     * Gets query for [[TblStudsTranscripts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblStudsTranscripts()
    {
        return $this->hasMany(TblStudsTranscript::className(), ['student_id' => 'id']);
    }
}
