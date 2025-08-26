<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_app_quali_status".
 *
 * @property int $id
 * @property string $name
 *
 * @property TblAppQuali[] $tblAppQualis
 * @property TblQualiLog[] $tblQualiLogs
 */
class TblAppQualiStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_app_quali_status';
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
     * Gets query for [[TblAppQualis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblAppQualis()
    {
        return $this->hasMany(TblAppQuali::className(), ['status' => 'id']);
    }

    /**
     * Gets query for [[TblQualiLogs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblQualiLogs()
    {
        return $this->hasMany(TblQualiLog::className(), ['status' => 'id']);
    }
}
