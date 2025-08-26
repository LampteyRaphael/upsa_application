<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_semester".
 *
 * @property int $id
 * @property string $name
 *
 * @property TblCourse[] $tblCourses
 * @property TblLecturerCourse[] $tblLecturerCourses
 * @property TblRegisCourse[] $tblRegisCourses
 * @property TblStRegistration[] $tblStRegistrations
 * @property TblStud[] $tblStuds
 */
class TblSemester extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_semester';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
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
        ];
    }

    /**
     * Gets query for [[TblCourses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblCourses()
    {
        return $this->hasMany(TblCourse::className(), ['semester' => 'id']);
    }

    /**
     * Gets query for [[TblLecturerCourses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblLecturerCourses()
    {
        return $this->hasMany(TblLecturerCourse::className(), ['semester' => 'id']);
    }

    /**
     * Gets query for [[TblRegisCourses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblRegisCourses()
    {
        return $this->hasMany(TblRegisCourse::className(), ['semester_id' => 'id']);
    }

    /**
     * Gets query for [[TblStRegistrations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblStRegistrations()
    {
        return $this->hasMany(TblStRegistration::className(), ['semester' => 'id']);
    }

    /**
     * Gets query for [[TblStuds]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblStuds()
    {
        return $this->hasMany(TblStud::className(), ['semester' => 'id']);
    }
}
