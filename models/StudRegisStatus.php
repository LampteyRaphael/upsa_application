<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stud_regis_status".
 *
 * @property int $id
 * @property string $name
 *
 * @property TblStudRegistYear[] $tblStudRegistYears
 */
class StudRegisStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stud_regis_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 45],
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
     * Gets query for [[TblStudRegistYears]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblStudRegistYears()
    {
        return $this->hasMany(TblStudRegistYear::className(), ['status' => 'id']);
    }
}
