<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_lecturer_course".
 *
 * @property int $id
 * @property int $semester
 * @property int $acadamic_year
 * @property int $lecturer_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property TblStudAcadamicYear $acadamicYear
 * @property TblLecturer $lecturer
 * @property TblSemester $semester0
 */
class TblLecturerCourse extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_lecturer_course';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'semester', 'acadamic_year', 'lecturer_id'], 'required'],
            [['id', 'semester', 'acadamic_year', 'lecturer_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['lecturer_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblLecturer::className(), 'targetAttribute' => ['lecturer_id' => 'id']],
            [['acadamic_year'], 'exist', 'skipOnError' => true, 'targetClass' => TblStudAcadamicYear::className(), 'targetAttribute' => ['acadamic_year' => 'id']],
            [['semester'], 'exist', 'skipOnError' => true, 'targetClass' => TblSemester::className(), 'targetAttribute' => ['semester' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'semester' => 'Semester',
            'acadamic_year' => 'Acadamic Year',
            'lecturer_id' => 'Lecturer ID',
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
        return $this->hasOne(TblStudAcadamicYear::className(), ['id' => 'acadamic_year']);
    }

    /**
     * Gets query for [[Lecturer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLecturer()
    {
        return $this->hasOne(TblLecturer::className(), ['id' => 'lecturer_id']);
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
}
