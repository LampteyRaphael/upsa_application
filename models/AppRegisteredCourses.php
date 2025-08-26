<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "app_registered_courses".
 *
 * @property int $id
 * @property int $course_id
 * @property int $program_id
 *
 * @property TblCourse $course
 * @property TblAppProgram $program
 */
class AppRegisteredCourses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'app_registered_courses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['course_id', 'program_id'], 'required'],
            [['course_id', 'program_id'], 'integer'],
            // [['course_id'],'unique'],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblCourse::className(), 'targetAttribute' => ['course_id' => 'id']],
            [['program_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblAppProgram::className(), 'targetAttribute' => ['program_id' => 'id']],
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
            'program_id' => 'Program ID',
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
        return $this->hasOne(TblAppProgram::className(), ['id' => 'program_id']);
    }
}
