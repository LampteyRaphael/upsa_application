<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "app_registered_courses_stud".
 *
 * @property int $id
 * @property int $program_id
 * @property int $course_id
 *
 * @property TblCourse $course
 * @property TblAppStudProgram $program
 */
class AppRegisteredCoursesStud extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'app_registered_courses_stud';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'program_id', 'course_id'], 'required'],
            [['id', 'program_id', 'course_id'], 'integer'],
            [['id'], 'unique'],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblCourse::className(), 'targetAttribute' => ['course_id' => 'id']],
            [['program_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblAppStudProgram::className(), 'targetAttribute' => ['program_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'program_id' => 'Program ID',
            'course_id' => 'Course ID',
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
     * Gets query for [[Program]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProgram()
    {
        return $this->hasOne(TblAppStudProgram::className(), ['id' => 'program_id']);
    }
}
