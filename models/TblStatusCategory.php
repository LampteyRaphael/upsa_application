<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_status_category".
 *
 * @property int $id
 * @property string $name
 *
 * @property TblAcadamicYear[] $tblAcadamicYears
 * @property TblUser[] $tblUsers
 */
class TblStatusCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_status_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 10],
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
     * Gets query for [[TblAcadamicYears]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblAcadamicYears()
    {
        return $this->hasMany(TblAcadamicYear::className(), ['status' => 'id']);
    }

    /**
     * Gets query for [[TblUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblUsers()
    {
        return $this->hasMany(User::className(), ['status' => 'id']);
    }
}
