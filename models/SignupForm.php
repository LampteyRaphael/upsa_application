<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;
use app\models\Validate2;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $phone_number;
    public $nationality;
    public $first_name;
    public $last_name;
    public $password_hash;
    public $studOption;
    public $studentID;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username'], 'trim'],
            [['username'], 'required'],
            // [['username'], 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            [['username'], 'string', 'min' => 2, 'max' => 255],

            [['email'], 'trim'],
            [['email'], 'required'],
            [['email'], 'email'],
            [['email'], 'string', 'max' => 255],
            [['email'], 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],

            [['password'], 'required'],
            // [['password'], 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

            [['phone_number'], 'trim'],
            [['phone_number'], 'required'],
            [['phone_number'], 'integer'],
            [['phone_number'], 'unique'],

            [['nationality'], 'trim'],
            [['nationality'], 'required'],
            [['nationality'], 'string', 'max' => 255],

            [['first_name'], 'trim'],
            [['first_name'], 'required'],
            [['first_name'], 'string'],


            [['last_name'], 'trim'],
            [['last_name'], 'required'],
            [['last_name'], 'string'],


            [['studOption'], 'required'],

            [['studentID'], 'trim'],
            [['studentID'], 'integer'],
            



            
        ];
    }


 
    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function osnup()
    {

        $apps=new Validate2();
        $student_index_number = $apps->student_index_number();
        $user = new TblOsn();
        $user->username = $this->first_name. ' ' . ' ' .$this->last_name;
        $user->email = $this->email;
        $user->phone_number = $this->phone_number;
        $user->nationality=$this->nationality;
        $user->first_name=$this->first_name;
        $user->last_name=$this->last_name;
        $user->password_hash=Yii::$app->security->generatePasswordHash($this->password);
        $user->status = 0;
        $user->year=date('Y');
        $user->role_id=1;
        $user->osn_number=$student_index_number;
        $user->studOption=$this->studOption;
        $user->studentID=$this->studentID;
        $user->auth_key=Yii::$app->security->generateRandomString();
        $user->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
        if($user->save()){
            // $this->sendEmail($user);
            return $user->id;
        }

          Yii::$app->session->setFlash('error',"Data Already Exist");


        // return $user->save() && $this->sendEmail($user);
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        error_reporting(false);
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }

}
