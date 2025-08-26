<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "doc_sub_tbl".
 *
 * @property int $id
 * @property string $doc_name
 * @property int $app_doc_id
 *
 * @property TblAppDocument $appDoc
 */
class DocSubTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'doc_sub_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['doc_name', 'app_doc_id'], 'required'],
            [['app_doc_id'], 'integer'],
            [['doc_name'], 'file', 'extensions' => 'pdf', 'maxFiles' => 4],
            [['app_doc_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblAppDocument::className(), 'targetAttribute' => ['app_doc_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'doc_name' => 'Doc Name',
            'app_doc_id' => 'App Doc ID',
        ];
    }

    /**
     * Gets query for [[AppDoc]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppDoc()
    {
        return $this->hasOne(TblAppDocument::className(), ['id' => 'app_doc_id']);
    }
}
