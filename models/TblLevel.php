<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_level".
 *
 * @property int $id
 * @property string $level_name
 *
 * @property TblProgram[] $tblPrograms
 */
class TblLevel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_level';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['level_name'], 'required'],
            [['level_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'level_name' => 'Level Name',
        ];
    }

    /**
     * Gets query for [[TblPrograms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblPrograms()
    {
        return $this->hasMany(TblProgram::className(), ['level_id' => 'id']);
    }
}
