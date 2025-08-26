<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_studs_transcript".
 *
 * @property int $id
 * @property int|null $student_id
 * @property int|null $student_result_id
 * @property int|null $course_id
 * @property int|null $semester_id
 * @property int|null $section_id
 * @property int|null $grade_id
 * @property int|null $status_id
 * @property int|null $course_lecture_id
 * @property int|null $acadamic_year
 * @property string|null $date_of_entry
 * @property string|null $class_marks
 * @property string|null $exams_marks
 * @property string|null $total_marks
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property TblStudRegistYear $acadamicYear
 * @property TblCourse $course
 * @property TblCourseLecturer $courseLecture
 * @property TblStudGrade $grade
 * @property TblSection $section
 * @property TblSemester $semester
 * @property TblStudResultCategory $status
 * @property TblStud $student
 * @property TblStudsResult $studentResult
 */
class TblStudsTranscript extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_studs_transcript';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['student_id', 'student_result_id', 'course_id', 'semester_id', 'section_id', 'grade_id', 'status_id', 'course_lecture_id', 'acadamic_year'], 'integer'],
            [['date_of_entry', 'created_at', 'updated_at'], 'safe'],
            // [['class_marks', 'exams_marks', 'total_marks'], 'string', 'max' => 45],
            [['acadamic_year'], 'exist', 'skipOnError' => true, 'targetClass' => TblStudRegistYear::className(), 'targetAttribute' => ['acadamic_year' => 'id']],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblCourse::className(), 'targetAttribute' => ['course_id' => 'id']],
            [['course_lecture_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblCourseLecturer::className(), 'targetAttribute' => ['course_lecture_id' => 'id']],
            [['grade_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblStudGrade::className(), 'targetAttribute' => ['grade_id' => 'id']],
            [['section_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblSection::className(), 'targetAttribute' => ['section_id' => 'id']],
            [['semester_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblSemester::className(), 'targetAttribute' => ['semester_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblStudResultCategory::className(), 'targetAttribute' => ['status_id' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblStud::className(), 'targetAttribute' => ['student_id' => 'id']],
            [['student_result_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblStudsResult::className(), 'targetAttribute' => ['student_result_id' => 'id']],
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
            'student_result_id' => 'Student Result ID',
            'course_id' => 'Course ID',
            'semester_id' => 'Semester ID',
            'section_id' => 'Section ID',
            'grade_id' => 'Grade ID',
            'status_id' => 'Status ID',
            'course_lecture_id' => 'Course Lecture ID',
            'acadamic_year' => 'Acadamic Year',
            'date_of_entry' => 'Date Of Entry',
            'class_marks' => 'Class Marks',
            'exams_marks' => 'Exams Marks',
            'total_marks' => 'Total Marks',
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
     * Gets query for [[Course]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(TblCourse::className(), ['id' => 'course_id']);
    }

    /**
     * Gets query for [[CourseLecture]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourseLecture()
    {
        return $this->hasOne(TblCourseLecturer::className(), ['id' => 'course_lecture_id']);
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
     * Gets query for [[Section]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSection()
    {
        return $this->hasOne(TblSection::className(), ['id' => 'section_id']);
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
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(TblStudResultCategory::className(), ['id' => 'status_id']);
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
     * Gets query for [[StudentResult]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentResult()
    {
        return $this->hasOne(TblStudsResult::className(), ['id' => 'student_result_id']);
    }
}
