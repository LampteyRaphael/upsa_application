<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_admission_professional_temp".
 *
 * @property int $id
 * @property string|null $text
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class TblAdmissionProfessionalTemp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_admission_professional_temp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
