<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_section".
 *
 * @property int $id
 * @property string $name
 * @property string|null $semester
 *
 * @property TblCourse[] $tblCourses
 * @property TblCourseLecturer[] $tblCourseLecturers
 * @property TblStRegistration[] $tblStRegistrations
 * @property TblStud[] $tblStuds
 * @property TblStudResult[] $tblStudResults
 */
class TblSection extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_section';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['semester'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'semester' => 'Semester',
        ];
    }

    /**
     * Gets query for [[TblCourses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblCourses()
    {
        return $this->hasMany(TblCourse::className(), ['section_id' => 'id']);
    }

    /**
     * Gets query for [[TblCourseLecturers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblCourseLecturers()
    {
        return $this->hasMany(TblCourseLecturer::className(), ['section_id' => 'id']);
    }

    /**
     * Gets query for [[TblStRegistrations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblStRegistrations()
    {
        return $this->hasMany(TblStRegistration::className(), ['section_id' => 'id']);
    }

    /**
     * Gets query for [[TblStuds]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblStuds()
    {
        return $this->hasMany(TblStud::className(), ['section_id' => 'id']);
    }

    /**
     * Gets query for [[TblStudResults]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblStudResults()
    {
        return $this->hasMany(TblStudResult::className(), ['section_id' => 'id']);
    }
}
