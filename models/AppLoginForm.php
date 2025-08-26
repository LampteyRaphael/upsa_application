<?php
namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class AppLoginForm extends Model
{
    public $username;
    public $password;
    public $email;
    public $rememberMe = true;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */ 
    public function login()
    {        
        if ($this->validate()) {

            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 900 * 1 * 1 : 0);
        }
        
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return AppUser|null
     */
    protected function getUser()
    {

        if ($this->_user === null) {


            $this->_user=AppUser::find()->andwhere(['email' => $this->email])->andwhere(['status' =>1])->andWhere(['role_id'=>1])->one();

            // $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
