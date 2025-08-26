<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_staff_category".
 *
 * @property int $id
 * @property string $name
 *
 * @property TblStaffList[] $tblStaffLists
 */
class TblStaffCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_staff_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
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
        return $this->hasMany(TblStaffList::className(), ['staff_category_id' => 'id']);
    }
}
