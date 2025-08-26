<?php

namespace app\models;

use Mpdf\Tag\Span;
use Yii;

/**
 * This is the model class for table "tbl_app_admission".
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $status
 * @property int $accadamin_year_id
 * @property int $application_id
 * @property string|null $doa
 * @property string|null $doc
 * @property string $created_at
 * @property string $updated_at
 *
 * @property TblApp $application
 * @property TblAppAdmissStatus $status0
 * @property TblAcadamicYear $accadaminYear
 * @property User $user
 */
class TblAppAdmission extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_app_admission';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'accadamin_year_id', 'application_id'], 'required'],
            [['user_id', 'status', 'accadamin_year_id', 'application_id'], 'integer'],
            [['admission_id'],'string'],
            [['application_id'],'unique'],
            [['doa', 'doc', 'created_at', 'updated_at'], 'safe'],
            [['application_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblApp::className(), 'targetAttribute' => ['application_id' => 'id']],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => TblAppAdmissStatus::className(), 'targetAttribute' => ['status' => 'id']],
            [['accadamin_year_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblAcadamicYear::className(), 'targetAttribute' => ['accadamin_year_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User',
            'status' => 'Status',
            'accadamin_year_id' => 'Accadamin Year',
            'application_id' => 'Application',
            'doa' => 'Doa',
            'doc' => 'Doc',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Application]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApplication()
    {
        return $this->hasOne(TblApp::className(), ['id' => 'application_id']);
    }

    /**
     * Gets query for [[Status0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus0()
    {
        return $this->hasOne(TblAppAdmissStatus::className(), ['id' => 'status']);
    }

    /**
     * Gets query for [[AccadaminYear]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAccadaminYear()
    {
        return $this->hasOne(TblAcadamicYear::className(), ['id' => 'accadamin_year_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getFullName()
    {
        return   ($this->application->personalDetails->title0->name??'') . ' ' . $this->application->personalDetails->first_name . ' ' .  ($this->application->personalDetails->middle_name??''). ' ' . ($this->application->personalDetails->last_name??'') . ' ' . ($this->application->personalAddress->telephone_number??'') . '  ' . ($this->application->osn0->osn_number??'') . ' '  . '  ' . '  ' . ($this->application->osn0->pin_code??'');
    }




 
}
