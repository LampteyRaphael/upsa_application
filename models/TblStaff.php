<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_staff".
 *
 * @property int $id
 * @property int $staff_id
 * @property int $department_id
 * @property string|null $staff_description
 *
 * @property TblDepart $department
 * @property TblStaffList $staff
 */
class TblStaff extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_staff';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['staff_id', 'department_id'], 'required'],
            [['staff_id', 'department_id'], 'integer'],
            [['staff_description'], 'string', 'max' => 255],
            [['staff_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblStaffList::className(), 'targetAttribute' => ['staff_id' => 'id']],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblDepart::className(), 'targetAttribute' => ['department_id' => 'id']],
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
            'department_id' => 'Department ID',
            'staff_description' => 'Staff Description',
        ];
    }

    /**
     * Gets query for [[Department]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(TblDepart::className(), ['id' => 'department_id']);
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
}
