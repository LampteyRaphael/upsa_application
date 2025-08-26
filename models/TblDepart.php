<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_depart".
 *
 * @property int $id
 * @property string $department_name
 * @property string|null $department_code
 * @property string|null $department_phone_number
 * @property string|null $department_office
 *
 * @property TblCourseDepart[] $tblCourseDeparts
 * @property TblLecturer[] $tblLecturers
 * @property TblStaff[] $tblStaff
 */
class TblDepart extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_depart';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['department_name'], 'required'],
            [['department_name', 'department_office'], 'string', 'max' => 255],
            [['department_code', 'department_phone_number'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'department_name' => 'Department Name',
            'department_code' => 'Department Code',
            'department_phone_number' => 'Department Phone Number',
            'department_office' => 'Department Office',
        ];
    }

    /**
     * Gets query for [[TblCourseDeparts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblCourseDeparts()
    {
        return $this->hasMany(TblCourseDepart::className(), ['depart_id' => 'id']);
    }

    /**
     * Gets query for [[TblLecturers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblLecturers()
    {
        return $this->hasMany(TblLecturer::className(), ['depart_id' => 'id']);
    }

    /**
     * Gets query for [[TblStaff]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblStaff()
    {
        return $this->hasMany(TblStaff::className(), ['department_id' => 'id']);
    }
}
