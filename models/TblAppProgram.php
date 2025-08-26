<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_app_program".
 *
 * @property int $id
 * @property int $tbl_program
 * @property int $osn_id
 *
 * @property TblOsn $osn
 * @property TblApp[] $tblApps
 * @property TblProgram $tblProgram
 */
class TblAppProgram extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_app_program';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tbl_program', 'osn_id'], 'required'],
            [['tbl_program', 'osn_id'], 'integer'],
            [['tbl_program'], 'exist', 'skipOnError' => true, 'targetClass' => TblProgram::className(), 'targetAttribute' => ['tbl_program' => 'id']],
            [['osn_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblOsn::className(), 'targetAttribute' => ['osn_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tbl_program' => 'Tbl Program',
            'osn_id' => 'Osn ID',
        ];
    }

    /**
     * Gets query for [[Osn]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOsn()
    {
        return $this->hasOne(TblOsn::className(), ['id' => 'osn_id']);
    }

    /**
     * Gets query for [[TblApps]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblApps()
    {
        return $this->hasMany(TblApp::className(), ['program_id' => 'id']);
    }

    /**
     * Gets query for [[TblProgram]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProgram()
    {
        return $this->hasOne(TblProgram::className(), ['id' => 'tbl_program']);
    }
}
