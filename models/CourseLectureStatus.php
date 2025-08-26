<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "course_lecture_status".
 *
 * @property int $course_lecturer_id
 * @property string $name
 *
 * @property TblCourseLecturer[] $tblCourseLecturers
 */
class CourseLectureStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'course_lecture_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'course_lecturer_id' => 'Course Lecturer ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[TblCourseLecturers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblCourseLecturers()
    {
        return $this->hasMany(TblCourseLecturer::className(), ['course_lecture_status_id' => 'course_lecturer_id']);
    }
}
