<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_course_lecturer".
 *
 * @property int $id
 * @property int $course_id
 * @property int $lecturer_id
 * @property int $section_id
 * @property int $course_lecture_status_id
 *
 * @property TblCourse $course
 * @property CourseLectureStatus $courseLectureStatus
 * @property TblStaffList $lecturer
 * @property TblSection $section
 */
class TblCourseLecturer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_course_lecturer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['course_id', 'lecturer_id', 'section_id', 'course_lecture_status_id'], 'required'],
            [['course_id', 'lecturer_id', 'section_id', 'course_lecture_status_id'], 'integer'],
            [['section_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblSection::className(), 'targetAttribute' => ['section_id' => 'id']],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblCourse::className(), 'targetAttribute' => ['course_id' => 'id']],
            [['course_lecture_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => CourseLectureStatus::className(), 'targetAttribute' => ['course_lecture_status_id' => 'course_lecturer_id']],
            [['lecturer_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblStaffList::className(), 'targetAttribute' => ['lecturer_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'course_id' => 'Course ID',
            'lecturer_id' => 'Lecturer ID',
            'section_id' => 'Section ID',
            'course_lecture_status_id' => 'Course Lecture Status ID',
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
     * Gets query for [[CourseLectureStatus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourseLectureStatus()
    {
        return $this->hasOne(CourseLectureStatus::className(), ['course_lecturer_id' => 'course_lecture_status_id']);
    }

    /**
     * Gets query for [[Lecturer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLecturer()
    {
        return $this->hasOne(TblStaffList::className(), ['id' => 'lecturer_id']);
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
}
