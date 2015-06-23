<?php

class UasersTest extends CDbTestCase
{

	public function testCreate()
	{
		$username = 'username';
		$password = 'password';
		$user = Users::create($username, $password);
		$this->assertNotNull($user);
    	$this->assertTrue($user instanceof Users);

		$user1 = Users::model()->findByPk($user->id);
    	$this->assertTrue($user1 instanceof Users);

		$this->assertEquals($user->username, $user1->username);


	}

	public function testCheckpass()
	{
		$username = 'username';
		$password = 'password';
		$user = Users::create($username, $password);
		$this->assertTrue($user->checkPassword($password));
	}
}