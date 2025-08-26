<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_stud_doc_type".
 *
 * @property int $id
 * @property string $name
 *
 * @property TblStudDoc[] $tblStudDocs
 */
class TblStudDocType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_stud_doc_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'],'unique'],
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

    /**
     * Gets query for [[TblStudDocs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblStudDocs()
    {
        return $this->hasMany(TblStudDoc::className(), ['document_category' => 'id']);
    }
}
