<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_lecturer".
 *
 * @property int $id
 * @property int $staff_id
 * @property int $progrm_id
 * @property int $depart_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property TblDepart $depart
 * @property TblProgram $progrm
 * @property TblStaffList $staff
 * @property TblCourseLecturer[] $tblCourseLecturers
 * @property TblLecturerCourse[] $tblLecturerCourses
 */
class TblLecturer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_lecturer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['staff_id', 'progrm_id', 'depart_id'], 'required'],
            [['staff_id', 'progrm_id', 'depart_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['staff_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblStaffList::className(), 'targetAttribute' => ['staff_id' => 'id']],
            [['depart_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblDepart::className(), 'targetAttribute' => ['depart_id' => 'id']],
            [['progrm_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblProgram::className(), 'targetAttribute' => ['progrm_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'staff_id' => 'Staff ID',
            'progrm_id' => 'Progrm ID',
            'depart_id' => 'Depart ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Depart]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepart()
    {
        return $this->hasOne(TblDepart::className(), ['id' => 'depart_id']);
    }

    /**
     * Gets query for [[Progrm]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProgrm()
    {
        return $this->hasOne(TblProgram::className(), ['id' => 'progrm_id']);
    }

    /**
     * Gets query for [[Staff]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStaff()
    {
        return $this->hasOne(TblStaffList::className(), ['id' => 'staff_id']);
    }

    /**
     * Gets query for [[TblCourseLecturers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblCourseLecturers()
    {
        return $this->hasMany(TblCourseLecturer::className(), ['lecturer_id' => 'id']);
    }

    /**
     * Gets query for [[TblLecturerCourses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblLecturerCourses()
    {
        return $this->hasMany(TblLecturerCourse::className(), ['lecturer_id' => 'id']);
    }
}
