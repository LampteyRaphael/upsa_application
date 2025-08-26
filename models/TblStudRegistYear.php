<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_stud_regist_year".
 *
 * @property int $id
 * @property int $stud_acadamic_year_id
 * @property string $date
 * @property int $semester
 * @property int $status
 *
 * @property TblSemester $semester0
 * @property StudRegisStatus $status0
 * @property TblStudAcadYear $studAcadamicYear
 * @property TblRegisCourse[] $tblRegisCourses
 * @property TblStRegistration[] $tblStRegistrations
 */
class TblStudRegistYear extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_stud_regist_year';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['stud_acadamic_year_id', 'date', 'semester', 'status'], 'required'],
            [['stud_acadamic_year_id', 'semester', 'status'], 'integer'],
            [['date'], 'safe'],
            [['semester'], 'exist', 'skipOnError' => true, 'targetClass' => TblSemester::className(), 'targetAttribute' => ['semester' => 'id']],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => StudRegisStatus::className(), 'targetAttribute' => ['status' => 'id']],
            [['stud_acadamic_year_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblStudAcadYear::className(), 'targetAttribute' => ['stud_acadamic_year_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'stud_acadamic_year_id' => 'Stud Acadamic Year ID',
            'date' => 'Date',
            'semester' => 'Semester',
            'status' => 'Status',
        ];
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

    /**
     * Gets query for [[Status0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus0()
    {
        return $this->hasOne(StudRegisStatus::className(), ['id' => 'status']);
    }

    /**
     * Gets query for [[StudAcadamicYear]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudAcadamicYear()
    {
        return $this->hasOne(TblStudAcadYear::className(), ['id' => 'stud_acadamic_year_id']);
    }

    /**
     * Gets query for [[TblRegisCourses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblRegisCourses()
    {
        return $this->hasMany(TblRegisCourse::className(), ['acadamic_year' => 'id']);
    }

    /**
     * Gets query for [[TblStRegistrations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblStRegistrations()
    {
        return $this->hasMany(TblStRegistration::className(), ['acadamic_year' => 'id']);
    }
}
