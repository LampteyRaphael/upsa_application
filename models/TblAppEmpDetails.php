<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_app_emp_details".
 *
 * @property int $id
 * @property string|null $company_name
 * @property string|null $position
 * @property string|null $employer_address
 * @property int|null $employer_telephone_number
 *
 * @property TblApp[] $tblApps
 */
class TblAppEmpDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_app_emp_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['osn_id'],'required'],
            [['osn_id'],'unique'],
            [['employer_telephone_number'],'string','max' => 20],
            [['company_name', 'employer_address'], 'string', 'max' => 255],
            [['position'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_name' => 'Company Name',
            'position' => 'Position',
            'employer_address' => 'Employer Address',
            'employer_telephone_number' => 'Employer Telephone Number',
        ];
    }

    /**
     * Gets query for [[TblApps]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblApps()
    {
        return $this->hasMany(TblApp::className(), ['personal_employment_id' => 'id']);
    }
}
