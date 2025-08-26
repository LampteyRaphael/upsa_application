<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_program".
 *
 * @property int $id
 * @property string $program_name
 * @property string $program_code
 * @property float|null $amount
 * @property int $program_category_id
 * @property int $level_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property AppRegisteredCourses[] $appRegisteredCourses
 * @property TblAppProgram[] $tblAppPrograms
 * @property TblAppStudProgram[] $tblAppStudPrograms
 * @property TblCourse[] $tblCourses
 * @property TblLecturer[] $tblLecturers
 * @property TblProgramType $programCategory
 * @property TblLevel $level
 * @property TblStRegistration[] $tblStRegistrations
 * @property TblStudResult[] $tblStudResults
 */
class TblProgram extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_program';
    }

    public $name;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['program_name', 'program_code', 'program_category_id','session_id'], 'required'],
            [['amount'], 'number'],
            [['program_category_id', 'level_id','session_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['program_name'], 'string', 'max' => 255],
            [['program_code'], 'string', 'max' => 50],
            [['program_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblProgramType::className(), 'targetAttribute' => ['program_category_id' => 'id']],
            [['level_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblLevel::className(), 'targetAttribute' => ['level_id' => 'id']],
            [['session_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblSection::className(), 'targetAttribute' => ['session_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'program_name' => 'Program Name',
            'program_code' => 'Program Code',
            'amount' => 'Amount',
            'program_category_id' => 'Program Category',
            'level_id' => 'Level',
            'created_at' => 'Date Created',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[AppRegisteredCourses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppRegisteredCourses()
    {
        return $this->hasMany(AppRegisteredCourses::className(), ['program_id' => 'id']);
    }

    /**
     * Gets query for [[TblAppPrograms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblAppPrograms()
    {
        return $this->hasMany(TblAppProgram::className(), ['tbl_program' => 'id']);
    }

    /**
     * Gets query for [[TblAppStudPrograms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblAppStudPrograms()
    {
        return $this->hasMany(TblAppStudProgram::className(), ['tbl_program' => 'id']);
    }

    /**
     * Gets query for [[TblCourses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblCourses()
    {
        return $this->hasMany(TblCourse::className(), ['program_id' => 'id']);
    }


     /**
     * Gets query for [[TblCourses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSession()
    {
        return $this->hasOne(TblSection::className(), ['id' => 'session_id']);
    }

    /**
     * Gets query for [[TblLecturers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblLecturers()
    {
        return $this->hasMany(TblLecturer::className(), ['progrm_id' => 'id']);
    }

    /**
     * Gets query for [[ProgramCategory]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProgramCategory()
    {
        return $this->hasOne(TblProgramType::className(), ['id' => 'program_category_id']);
    }

    /**
     * Gets query for [[Level]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLevel()
    {
        return $this->hasOne(TblLevel::className(), ['id' => 'level_id']);
    }

    /**
     * Gets query for [[TblStRegistrations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblStRegistrations()
    {
        return $this->hasMany(TblStRegistration::className(), ['program_id' => 'id']);
    }

    /**
     * Gets query for [[TblStudResults]].
     *
     * @return \yii\db\ActiveQuery
     */
    
    public function getTblStaffLists()
    {
        return $this->hasMany(TblStaffList::className(), ['program_id' => 'id']);
    }
}