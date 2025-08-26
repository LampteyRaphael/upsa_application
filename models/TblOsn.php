<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;

/**
 * This is the model class for table "tbl_osn".
 *
 * @property int $id
 * @property string $osn_number
 * @property string $pin_code
 * @property int $status
 * @property string $studOption
 * @property string $studentID
 * @property string $year
 * @property string $transaction_no
 * @property string $created_at
 * @property string|null $updated_at
 *
 * @property TblApp[] $tblApps
 * @property TblAppAddress[] $tblAppAddresses
 * @property TblAppDocument[] $tblAppDocuments
 * @property TblAppEduBg[] $tblAppEduBgs
 * @property TblAppEmpDetails[] $tblAppEmpDetails
 * @property TblAppPersDetails[] $tblAppPersDetails
 * @property TblAppProgram[] $tblAppPrograms
 */
class TblOsn extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_osn';
    }

    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 2;
    const STATUS_ACTIVE = 1;

    const SCENARIO_LOGIN = 'login';
    const SCENARIO_CREATE = 'create';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['username','password_hash'], 'required'],
            [['status', 'role_id'], 'integer'],
            [['year', 'created_at', 'updated_at'], 'safe'],
            [['osn_number', 'transaction_no'], 'string'],
            ['osn_number', 'unique'],


            [['studOption'], 'string'],
            [['studentID', 'first_name', 'last_name', 'phone_number', 'nationality', 'username', 'auth_key', 'verification_token', 'password_hash'], 'string'],
            [['pin_code'], 'string'],


            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\TblOsn', 'message' => 'This email address has already been taken.'],


            ['phone_number', 'trim'],
            ['phone_number', 'required'],
            ['phone_number', 'string','max'=>15],
            ['phone_number', 'unique'],

            ['nationality', 'trim'],
            ['nationality', 'required'],
            ['nationality', 'string'],

            ['first_name', 'trim'],
            ['first_name', 'required'],
            ['first_name', 'string'],

            ['last_name', 'trim'],
            ['last_name', 'required'],
            ['last_name', 'string'],


            ['status_osn', 'string'],

        ];


    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'osn_number' => 'Osn Number',
            'pin_code' => 'Pin Code',
            'status' => 'Status',
            'studOption' => 'Option',
            'studentID' => 'Student ID',
            'year' => 'Year',
            'transaction_no' => 'Transaction No',
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
        return $this->hasMany(TblApp::className(), ['osn' => 'id']);
    }

    /**
     * Gets query for [[TblAppAddresses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblAppAddresses()
    {
        return $this->hasMany(TblAppAddress::className(), ['osn_id' => 'id']);
    }

    /**
     * Gets query for [[TblAppDocuments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblAppDocuments()
    {
        return $this->hasMany(TblAppDocument::className(), ['osn_id' => 'id']);
    }

    /**
     * Gets query for [[TblAppEduBgs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblAppEduBgs()
    {
        return $this->hasMany(TblAppEduBg::className(), ['osn_id' => 'id']);
    }

    /**
     * Gets query for [[TblAppEmpDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblAppEmpDetails()
    {
        return $this->hasMany(TblAppEmpDetails::className(), ['osn_id' => 'id']);
    }

    /**
     * Gets query for [[TblAppPersDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblAppPersDetails()
    {
        return $this->hasMany(TblAppPersDetails::className(), ['osn_id' => 'id']);
    }

    /**
     * Gets query for [[TblAppPrograms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblAppPrograms()
    {
        return $this->hasMany(TblAppProgram::className(), ['osn_id' => 'id']);
    }


      /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
   
     public static function findIdentity($id) {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public static function findByUsername($username) {
        return static::findOne(['username' => $username]);
    }

    public function getId() {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    // public function getAuthKey() {
    //     return $this->authKey;
    // }


     /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

     /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

      /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

       /**
     * Generates new token for email verification
     */
    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

      /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }


    public function setPasswords($password){
        return Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }


    // public function validateAuthKey($authKey) {
    //     return $this->authKey === $authKey;
    // }

    // public function validatePassword($password) {
    //     return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    // }

       /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

}

