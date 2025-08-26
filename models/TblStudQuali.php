<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_stud_quali".
 *
 * @property int $id
 * @property int $students_id
 * @property int $status
 * @property int $user_id
 * @property int $accadamin_year_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property TblStudAcadYear $accadaminYear
 * @property TblStudAdmisStatus $status0
 * @property TblUser $user
 */
class TblStudQuali extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_stud_quali';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['students_id', 'status', 'user_id', 'accadamin_year_id'], 'required'],
            [['students_id', 'status', 'user_id', 'accadamin_year_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => TblStudAdmisStatus::className(), 'targetAttribute' => ['status' => 'id']],
            [['accadamin_year_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblStudAcadYear::className(), 'targetAttribute' => ['accadamin_year_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblUser::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'accadamin_year_id' => 'Accadamin Year ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
     * Gets query for [[Status0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus0()
    {
        return $this->hasOne(TblStudAdmisStatus::className(), ['id' => 'status']);
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
}
