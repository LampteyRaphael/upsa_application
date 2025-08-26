<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_role".
 *
 * @property int $id
 * @property string $name
 *
 * @property TblUser[] $tblUsers
 */
class TblRole extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_role';
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
     * Gets query for [[TblUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblUsers()
    {
        return $this->hasMany(TblUser::className(), ['role_id' => 'id']);
    }
}
