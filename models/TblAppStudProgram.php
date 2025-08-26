<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_app_stud_program".
 *
 * @property int $id
 * @property int $tbl_program
 * @property int|null $course_id
 * @property int|null $stud_per_id
 *
 * @property TblCourse $course
 * @property TblStudPersDetails $studPer
 * @property TblProgram $tblProgram
 * @property TblStud[] $tblStuds
 */
class TblAppStudProgram extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_app_stud_program';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tbl_program'], 'required'],
            [['tbl_program', 'course_id', 'stud_per_id'], 'integer'],
            // [['stud_per_id'],'unique'],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblCourse::className(), 'targetAttribute' => ['course_id' => 'id']],
            [['tbl_program'], 'exist', 'skipOnError' => true, 'targetClass' => TblProgram::className(), 'targetAttribute' => ['tbl_program' => 'id']],
            [['stud_per_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblStudPersDetails::className(), 'targetAttribute' => ['stud_per_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tbl_program' => 'Tbl Program',
            'course_id' => 'Course ID',
            'stud_per_id' => 'Stud Per ID',
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
     * Gets query for [[StudPer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudPer()
    {
        return $this->hasOne(TblStudPersDetails::className(), ['id' => 'stud_per_id']);
    }

    /**
     * Gets query for [[TblProgram]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProgram()
    {
        return $this->hasOne(TblProgram::className(), ['id' => 'tbl_program']);
    }

    /**
     * Gets query for [[TblStuds]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblStuds()
    {
        return $this->hasMany(TblStud::className(), ['program_id' => 'id']);
    }
}
