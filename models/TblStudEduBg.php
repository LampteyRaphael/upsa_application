<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_stud_edu_bg".
 *
 * @property int $id
 * @property string $institution
 * @property string $program_offered
 * @property int $stud_per_id
 * @property string $date
 * @property string $created_at
 * @property string $updated_at
 *
 * @property TblStudPersDetails $studPer
 * @property TblStud[] $tblStuds
 */
class TblStudEduBg extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_stud_edu_bg';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['institution', 'program_offered', 'stud_per_id', 'date'], 'required'],
            [['stud_per_id'], 'integer'],
            [['stud_per_id'],'unique'],
            [['date', 'created_at', 'updated_at'], 'safe'],
            [['institution', 'program_offered'], 'string', 'max' => 255],
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
            'institution' => 'Institution',
            'program_offered' => 'Program Offered',
            'stud_per_id' => 'Stud Per ID',
            'date' => 'Date',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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

    /**
     * Gets query for [[TblStuds]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblStuds()
    {
        return $this->hasMany(TblStud::className(), ['personal_education_id' => 'id']);
    }
}
