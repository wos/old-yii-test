<?php

class UsersController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	public $defaultAction = 'login';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('login', 'registration'),
				'users'=>array('*'),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('logout'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionLogin(){
		if(!Yii::app()->user->isGuest)
			$this->redirect($this->createUrl('files/index'));

        $model=new LoginForm;
		if(isset($_POST['LoginForm'])){
			$model->attributes=$_POST['LoginForm'];
			if($model->validate() && $model->login())
				$this->redirect($this->createUrl('files/index'));
		}
		$this->render('login',array('model'=>$model))  ;
	}

	/**
	 * Регистрация пользователя
	 */
	public function actionRegistration()
	{
		$model=new RegistrationForm;
		if (isset($_POST['RegistrationForm'])){
			$model->attributes=$_POST['RegistrationForm'];
			if ($model->validate() && $new_user = $model->registration()) {
				$this->redirect(array('users/login'));
			}
		}
		$this->render('registration', array('model'=>$model));
	}

	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect($this->createUrl('users/login'));
	}
}
