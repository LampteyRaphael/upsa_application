<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_regis_course".
 *
 * @property int $id
 * @property int $semester_id
 * @property int $acadamic_year
 * @property int $stud_regis_id
 * @property int $course_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property TblCourse $course
 * @property TblStRegistration $studRegis
 * @property TblSemester $semester
 * @property TblStudAcadamicYear $acadamicYear
 */
class TblRegisCourse extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_regis_course';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['semester_id', 'acadamic_year', 'stud_regis_id', 'course_id'], 'required'],
            [['semester_id', 'acadamic_year', 'stud_regis_id', 'course_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblCourse::className(), 'targetAttribute' => ['course_id' => 'id']],
            [['stud_regis_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblStRegistration::className(), 'targetAttribute' => ['stud_regis_id' => 'id']],
            [['semester_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblSemester::className(), 'targetAttribute' => ['semester_id' => 'id']],
            [['acadamic_year'], 'exist', 'skipOnError' => true, 'targetClass' => TblStudAcadamicYear::className(), 'targetAttribute' => ['acadamic_year' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'semester_id' => 'Semester',
            'acadamic_year' => 'Acadamic Year',
            'stud_regis_id' => 'Stud Regis',
            'course_id' => 'Course',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Course]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(TblCourse::className(), ['id' => 'course_id']);
    }

    /**
     * Gets query for [[StudRegis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudRegis()
    {
        return $this->hasOne(TblStRegistration::className(), ['id' => 'stud_regis_id']);
    }

    /**
     * Gets query for [[Semester]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSemester()
    {
        return $this->hasOne(TblSemester::className(), ['id' => 'semester_id']);
    }

    /**
     * Gets query for [[AcadamicYear]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAcadamicYear()
    {
        return $this->hasOne(TblStudAcadamicYear::className(), ['id' => 'acadamic_year']);
    }
}
