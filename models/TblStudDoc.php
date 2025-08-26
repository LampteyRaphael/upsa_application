<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_stud_doc".
 *
 * @property int $id
 * @property string $doc_name
 * @property int $stud_per_id
 *
 * @property TblStudPersDetails $studPer
 */
class TblStudDoc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_stud_doc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['doc_name', 'stud_per_id'], 'required'],
            [['stud_per_id'], 'integer'],
            [['doc_name'],'unique'],
            [['doc_name'], 'string', 'max' => 255],
            [['stud_per_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblStudPersDetails::className(), 'targetAttribute' => ['stud_per_id' => 'id']],
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
            'stud_per_id' => 'Stud Per ID',
        ];
    }

    /**
     * Gets query for [[StudPer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudPer()
    {
        return $this->hasOne(TblStudPersDetails::className(), ['id' => 'stud_per_id']);
    }
}
