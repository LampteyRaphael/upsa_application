<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_app_document".
 *
 * @property int $id
 * @property int $personalDetail_id
 * @property string $doc_name
 * @property string $created_at
 *
 * @property TblAppPersDetails $personalDetail
 */
class TblAppDocument extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_app_document';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['personalDetail_id', 'doc_name','category'], 'required'],
            [['personalDetail_id'], 'integer'],
            [['created_at'], 'safe'],
            [['doc_name'],'file', 'extensions' => 'pdf','maxSize' => 1024 * 1024],
            [['personalDetail_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblAppPersDetails::className(), 'targetAttribute' => ['personalDetail_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'personalDetail_id' => 'Personal Detail ID',
            'doc_name' => 'Document File',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[PersonalDetail]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonalDetail()
    {
        return $this->hasOne(TblAppPersDetails::className(), ['id' => 'personalDetail_id']);
    }
}
