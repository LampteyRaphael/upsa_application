<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_st_registration".
 *
 * @property int $id
 * @property int $stud_Id
 * @property int $program_id
 * @property int $level_id
 * @property int $acadamic_year
 * @property int $status
 * @property int $semester
 * @property int $section_id
 * @property string $date_o_regis
 * @property int $courese_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property TblStudRegistYear $acadamicYear
 * @property TblCourse $courese
 * @property TblLevel $level
 * @property TblProgram $program
 * @property TblSection $section
 * @property TblSemester $semester0
 * @property TblRegistCourseStatus $status0
 * @property TblStud $stud
 * @property TblRegisCourse[] $tblRegisCourses
 */
class TblStRegistration extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_st_registration';
    }

    public $file;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['stud_Id', 'program_id', 'level_id', 'acadamic_year', 'status', 'semester', 'section_id', 'date_o_regis', 'courese_id'], 'required'],
            [['stud_Id', 'program_id', 'level_id', 'acadamic_year', 'status', 'semester', 'section_id', 'courese_id'], 'integer'],
            [['date_o_regis', 'created_at', 'updated_at'], 'safe'],
            [['file'],'file'],
            [['level_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblLevel::className(), 'targetAttribute' => ['level_id' => 'id']],
            [['program_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblProgram::className(), 'targetAttribute' => ['program_id' => 'id']],
            [['section_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblSection::className(), 'targetAttribute' => ['section_id' => 'id']],
            [['semester'], 'exist', 'skipOnError' => true, 'targetClass' => TblSemester::className(), 'targetAttribute' => ['semester' => 'id']],
            [['acadamic_year'], 'exist', 'skipOnError' => true, 'targetClass' => TblStudRegistYear::className(), 'targetAttribute' => ['acadamic_year' => 'id']],
            [['stud_Id'], 'exist', 'skipOnError' => true, 'targetClass' => TblStud::className(), 'targetAttribute' => ['stud_Id' => 'id']],
            [['courese_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblCourse::className(), 'targetAttribute' => ['courese_id' => 'id']],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => TblRegistCourseStatus::className(), 'targetAttribute' => ['status' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'stud_Id' => 'Stud  ID',
            'program_id' => 'Program ID',
            'level_id' => 'Level ID',
            'acadamic_year' => 'Acadamic Year',
            'status' => 'Status',
            'semester' => 'Semester',
            'section_id' => 'Section ID',
            'date_o_regis' => 'Date O Regis',
            'courese_id' => 'Courese ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[AcadamicYear]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAcadamicYear()
    {
        return $this->hasOne(TblStudRegistYear::className(), ['id' => 'acadamic_year']);
    }

    /**
     * Gets query for [[Courese]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourese()
    {
        return $this->hasOne(TblCourse::className(), ['id' => 'courese_id']);
    }

    /**
     * Gets query for [[Level]].
     *
     * @return \yii\db\ActiveQuery
     */

    // protected $with=['level'];
    public function getLevel()
    {
        return $this->hasOne(TblLevel::className(), ['id' => 'level_id']);
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
     * Gets query for [[Section]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSection()
    {
        return $this->hasOne(TblSection::className(), ['id' => 'section_id']);
    }

    /**
     * Gets query for [[Semester0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSemester0()
    {
        return $this->hasOne(TblSemester::className(), ['id' => 'semester']);
    }

    /**
     * Gets query for [[Status0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus0()
    {
        return $this->hasOne(TblRegistCourseStatus::className(), ['id' => 'status']);
    }

    /**
     * Gets query for [[Stud]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStud()
    {
        return $this->hasOne(TblStud::className(), ['id' => 'stud_Id']);
    }

    /**
     * Gets query for [[TblRegisCourses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblRegisCourses()
    {
        return $this->hasMany(TblRegisCourse::className(), ['stud_regis_id' => 'id']);
    }
}
