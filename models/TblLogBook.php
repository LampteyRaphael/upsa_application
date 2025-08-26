<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_log_book".
 *
 * @property int $id
 * @property int $staff_id
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 *
 * @property TblStaffList $staff
 */
class TblLogBook extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_log_book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['staff_id', 'description'], 'required'],
            [['staff_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['description'], 'string', 'max' => 255],
            [['staff_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblStaffList::className(), 'targetAttribute' => ['staff_id' => 'id']],
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
            'description' => 'Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
