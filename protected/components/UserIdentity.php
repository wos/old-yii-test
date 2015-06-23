<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    /**
     * @var Users $user user model
     */
    public $user;

	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{

		// TODO: найти пользователя

		$this->user = Users::model()->find('username=:u', array(':u' => $this->username));;
		$this->errorCode=self::ERROR_NONE;

		if($this->user === null){
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		} else {
			// проверяем пароль
			if($this->password && $this->user->password ){
				if(!$this->user->checkPassword($this->password)){
					$this->errorCode = self::ERROR_PASSWORD_INVALID;
				}
			}
		}
		return $this->errorCode===self::ERROR_NONE;
	}
}