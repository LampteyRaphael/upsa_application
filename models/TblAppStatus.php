<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_app_status".
 *
 * @property int $id
 * @property string $name
 *
 * @property TblApp[] $tblApps
 */
class TblAppStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_app_status';
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
     * Gets query for [[TblApps]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblApps()
    {
        return $this->hasMany(TblApp::className(), ['status' => 'id']);
    }
}
