<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_app_edu_bg".
 *
 * @property int $id
 * @property string $institution
 * @property string $program_offered
 * @property string $index_number
 * @property string $session
 * @property string $date
 * @property string $created_at
 * @property string $updated_at
 *
 * @property TblApp[] $tblApps
 */
class TblAppEduBg extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_app_edu_bg';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['institution', 'program_offered', 'date','osn_id'], 'required'],
            [['osn_id'],'unique'],
            [['date', 'created_at', 'updated_at'], 'safe'],
            [['institution', 'program_offered'], 'string', 'max' => 255],
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
            'date' => 'Date',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[TblApps]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblApps()
    {
        return $this->hasMany(TblApp::className(), ['personal_education_id' => 'id']);
    }
}
