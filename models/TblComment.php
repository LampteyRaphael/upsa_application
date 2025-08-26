<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_comment".
 *
 * @property int $id
 * @property int $staff_id
 * @property string $description
 * @property string $reply
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property TblStaffList $staff
 */
class TblComment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'description','status'], 'required'],
            [['staff_id'], 'integer'],
            [['description', 'reply'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User',
            'description' => 'Description',
            'reply' => 'Reply',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Staff]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(TblStaffList::className(), ['id' => 'user_id']);
    }
}
