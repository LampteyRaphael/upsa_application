<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_title_tb".
 *
 * @property int $id
 * @property string $name
 *
 * @property TblStaffList[] $tblStaffLists
 * @property TblStudPersDetails[] $tblStudPersDetails
 */
class TblTitleTb extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_title_tb';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 20],
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
     * Gets query for [[TblStaffLists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblStaffLists()
    {
        return $this->hasMany(TblStaffList::className(), ['title' => 'id']);
    }

    /**
     * Gets query for [[TblStudPersDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblStudPersDetails()
    {
        return $this->hasMany(TblStudPersDetails::className(), ['title' => 'id']);
    }
}
