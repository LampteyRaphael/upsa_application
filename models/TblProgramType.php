<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_program_type".
 *
 * @property int $id
 * @property string $name
 *
 * @property TblProgram[] $tblPrograms
 */
class TblProgramType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_program_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','figure','amount'], 'required'],
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
            'figure'=>'Figures In Words'
        ];
    }

    /**
     * Gets query for [[TblPrograms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblPrograms()
    {
        return $this->hasMany(TblProgram::className(), ['program_category_id' => 'id']);
    }
}
