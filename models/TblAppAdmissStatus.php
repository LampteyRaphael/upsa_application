<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_app_admiss_status".
 *
 * @property int $id
 * @property string $name
 *
 * @property TblAdmissLog[] $tblAdmissLogs
 * @property TblAppAdmission[] $tblAppAdmissions
 */
class TblAppAdmissStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_app_admiss_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 50],
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
     * Gets query for [[TblAdmissLogs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblAdmissLogs()
    {
        return $this->hasMany(TblAdmissLog::className(), ['status' => 'id']);
    }

    /**
     * Gets query for [[TblAppAdmissions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblAppAdmissions()
    {
        return $this->hasMany(TblAppAdmission::className(), ['status' => 'id']);
    }
}
