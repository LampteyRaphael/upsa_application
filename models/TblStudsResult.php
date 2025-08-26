<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_studs_result".
 *
 * @property int $id
 * @property int|null $student_id
 * @property int|null $course_id
 * @property int|null $semester
 * @property int|null $section_id
 * @property int|null $class_marks
 * @property int|null $exams_marks
 * @property int|null $total_marks
 * @property int|null $grade_id
 * @property int|null $status
 * @property string|null $date_of_entry
 * @property int|null $course_lecture_id
 * @property int|null $acadamic_year
 * @property string $created_at
 * @property string|null $updated_at
 *
 * @property TblCourse $course
 * @property TblSection $section
 * @property TblStud $student
 * @property TblStudGrade $grade
 * @property TblSemester $semester0
 */
class TblStudsResult extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_studs_result';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['student_id', 'course_id', 'semester', 'section_id', 'grade_id', 'status', 'course_lecture_id', 'acadamic_year'], 'integer'],
            [['class_marks', 'exams_marks', 'total_marks'],'string'],
            [['date_of_entry', 'created_at', 'updated_at'], 'safe'],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblCourse::className(), 'targetAttribute' => ['course_id' => 'id']],
            [['section_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblSection::className(), 'targetAttribute' => ['section_id' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblStud::className(), 'targetAttribute' => ['student_id' => 'id']],
            [['grade_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblStudGrade::className(), 'targetAttribute' => ['grade_id' => 'id']],
            [['semester'], 'exist', 'skipOnError' => true, 'targetClass' => TblSemester::className(), 'targetAttribute' => ['semester' => 'id']],

            [['acadamic_year'], 'exist', 'skipOnError' => true, 'targetClass' => TblStudAcadYear::className(), 'targetAttribute' => ['acadamic_year' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_id' => 'Student ID',
            'course_id' => 'Course ID',
            'semester' => 'Semester',
            'section_id' => 'Section ID',
            'class_marks' => 'Class Marks',
            'exams_marks' => 'Exams Marks',
            'total_marks' => 'Total Marks',
            'grade_id' => 'Grade ID',
            'status' => 'Status',
            'date_of_entry' => 'Date Of Entry',
            'course_lecture_id' => 'Course Lecture ID',
            'acadamic_year' => 'Acadamic Year',
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
     * Gets query for [[Section]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSection()
    {
        return $this->hasOne(TblSection::className(), ['id' => 'section_id']);
    }

    /**
     * Gets query for [[Student]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(TblStud::className(), ['id' => 'student_id']);
    }

    /**
     * Gets query for [[Grade]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGrade()
    {
        return $this->hasOne(TblStudGrade::className(), ['id' => 'grade_id']);
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

    public function getAcadamicYear()
    {
        return $this->hasOne(TblStudAcadYear::className(), ['id' => 'acadamic_year']);
    }


}
