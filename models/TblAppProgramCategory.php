<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_app_program_category".
 *
 * @property int $id
 * @property string $name
 *
 * @property TblAppProgram[] $tblAppPrograms
 */
class TblAppProgramCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_app_program_category';
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
     * Gets query for [[TblAppPrograms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblAppPrograms()
    {
        return $this->hasMany(TblAppProgram::className(), ['tbl_qualification' => 'id']);
    }
}
