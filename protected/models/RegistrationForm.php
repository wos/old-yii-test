<?php

class RegistrationForm extends CFormModel
{

    public $username;
    public $password;
    public $password2; // для поля "повторите пароль"

    public function __construct(){
//        $userpass = Service::createRandWord(12);
//        $this->password = $userpass;
//        $this->password2 = $userpass;
//        $this->terms_and_conditions = true;
    }

    public function rules() {
        return array(
            array('username', 'required', 'message'=>'Имя пользователя'),
            array('password', 'required', 'message'=>'Пароль'),
            array('password2', 'required', 'message'=>'Подтверждение пароля'),
            array('password, password2', 'length', 'min'=>5, 'max'=>127,
                'tooShort'=>'Пароль слишком короткий.<br /> Выбирайте пароль не короче 5 символов',
                'tooLong'=>'Пароль слишком длинный.<br /> Выбирайте пароль не более 127 символов'),
            array('password2', 'compare', 'compareAttribute'=>'password',
                'message'=>'Вы указали разные пароли'),
            array('username', 'unique',
                'className' => 'Users',
                'attributeName' => 'username',
                'caseSensitive' => FALSE,
                'message'=>'Пользователь с таким именем пользователя<br /> уже зарегистрирован'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels(){
        return array(
            'username'             => 'Имя пользователя',
            'password'             => 'Пароль',
            'password2'            => 'Повторите пароль',
        );
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function registration(){
        $new_u = Users::create($this->username, $this->password);
        return $new_u;
    }
}
