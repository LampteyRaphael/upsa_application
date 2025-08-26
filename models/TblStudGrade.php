<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_stud_grade".
 *
 * @property int $id
 * @property string $grade_name
 * @property int $from
 * @property int $to
 * @property string $grade_point
 *
 * @property TblStudsResult[] $tblStudsResults
 */
class TblStudGrade extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_stud_grade';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['grade_name', 'from', 'to', 'grade_point'], 'required'],
            [['from', 'to'], 'integer'],
            [['grade_name'], 'string', 'max' => 255],
            [['grade_point'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'grade_name' => 'Grade Name',
            'from' => 'From',
            'to' => 'To',
            'grade_point' => 'Grade Point',
        ];
    }

    /**
     * Gets query for [[TblStudsResults]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblStudsResults()
    {
        return $this->hasMany(TblStudsResult::className(), ['grade_id' => 'id']);
    }
}
