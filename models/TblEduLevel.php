<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_title_tb".
 *
 * @property int $id
 * @property string $name
 *
 * @property TblAppPersDetails[] $tblAppPersDetails
 * @property TblStudPersDetails[] $tblStudPersDetails
 */
class TblEduLevel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_edu_level';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
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
}
