<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_stud_admis".
 *
 * @property int $id
 * @property int $students_id
 * @property int $status
 * @property int $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property int $accadamin_year_id
 * @property string $doa
 * @property string $doc
 *
 * @property TblStudAdmisStatus $status0
 * @property TblStudAcadYear $accadaminYear
 * @property TblUser $user
 * @property TblStud $students
 */
class TblStudAdmis extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_stud_admis';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['students_id', 'status', 'user_id', 'accadamin_year_id', 'doa', 'doc'], 'required'],
            [['students_id', 'status', 'user_id', 'accadamin_year_id'], 'integer'],
            [['created_at', 'updated_at', 'doa', 'doc'], 'safe'],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => TblStudAdmisStatus::className(), 'targetAttribute' => ['status' => 'id']],
            [['accadamin_year_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblStudAcadYear::className(), 'targetAttribute' => ['accadamin_year_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblUser::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['students_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblStud::className(), 'targetAttribute' => ['students_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'students_id' => 'Students ID',
            'status' => 'Status',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'accadamin_year_id' => 'Accadamin Year ID',
            'doa' => 'Doa',
            'doc' => 'Doc',
        ];
    }

    /**
     * Gets query for [[Status0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus0()
    {
        return $this->hasOne(TblStudAdmisStatus::className(), ['id' => 'status']);
    }

    /**
     * Gets query for [[AccadaminYear]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAccadaminYear()
    {
        return $this->hasOne(TblStudAcadYear::className(), ['id' => 'accadamin_year_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(TblUser::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query for [[Students]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasOne(TblStud::className(), ['id' => 'students_id']);
    }
}
