<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_staff_list".
 *
 * @property int $id
 * @property string $title
 * @property string $first_name
 * @property string $surname
 * @property string|null $middle_name
 * @property string|null $city
 * @property int|null $country
 * @property string $date_of_birth
 * @property string $ranks
 * @property int $depart_id
 * @property int|null $program_id
 * @property string|null $doa
 * @property string|null $telephone_number
 * @property int $user_id
 * @property int $staff_category_id
 * @property string $created_at
 * @property string|null $updated_at
 * @property string|null $dates
 *
 * @property TblCountry $country0
 * @property TblDepart $depart
 * @property TblProgram $program
 * @property TblStaffCategory $staffCategory
 * @property TblComment[] $tblComments
 * @property TblLecturer[] $tblLecturers
 * @property TblLogBook[] $tblLogBooks
 * @property TblUser $user
 */
class TblStaffList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_staff_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'first_name', 'surname', 'date_of_birth', 'ranks', 'depart_id', 'user_id', 'staff_category_id'], 'required'],
            [['country', 'depart_id', 'program_id', 'user_id', 'staff_category_id'], 'integer'],
            [['date_of_birth', 'doa', 'created_at', 'updated_at', 'dates'], 'safe'],
            [['title', 'ranks'], 'string', 'max' => 50],
            [['first_name', 'surname', 'middle_name', 'city'], 'string', 'max' => 255],
            [['telephone_number'], 'string', 'max' => 20],
            [['staff_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblStaffCategory::className(), 'targetAttribute' => ['staff_category_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['country'], 'exist', 'skipOnError' => true, 'targetClass' => TblCountry::className(), 'targetAttribute' => ['country' => 'id']],
            [['depart_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblDepart::className(), 'targetAttribute' => ['depart_id' => 'id']],
            [['program_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblProgram::className(), 'targetAttribute' => ['program_id' => 'id']],
            [['title'], 'exist', 'skipOnError' => true, 'targetClass' => TblTitleTb::className(), 'targetAttribute' => ['title' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'first_name' => 'First Name',
            'surname' => 'Surname',
            'middle_name' => 'Middle Name',
            'city' => 'City',
            'country' => 'Country',
            'date_of_birth' => 'Date Of Birth',
            'ranks' => 'Ranks',
            'depart_id' => 'Department',
            'program_id' => 'Programme',
            'doa' => 'Date Employed',
            'telephone_number' => 'Telephone Number',
            'user_id' => 'User',
            'staff_category_id' => 'Staff Category',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'dates' => 'Dates',
        ];
    }

    /**
     * Gets query for [[Country0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCountry0()
    {
        return $this->hasOne(TblCountry::className(), ['id' => 'country']);
    }
    public function getTitle0()
    {
        return $this->hasOne(TblTitleTb::className(), ['id' => 'title']);
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
     * Gets query for [[Program]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProgram()
    {
        return $this->hasOne(TblProgram::className(), ['id' => 'program_id']);
    }

    /**
     * Gets query for [[StaffCategory]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStaffCategory()
    {
        return $this->hasOne(TblStaffCategory::className(), ['id' => 'staff_category_id']);
    }

    /**
     * Gets query for [[TblComments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblComments()
    {
        return $this->hasMany(TblComment::className(), ['staff_id' => 'id']);
    }

    /**
     * Gets query for [[TblLecturers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblLecturers()
    {
        return $this->hasMany(TblLecturer::className(), ['staff_id' => 'id']);
    }

    /**
     * Gets query for [[TblLogBooks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblLogBooks()
    {
        return $this->hasMany(TblLogBook::className(), ['staff_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
