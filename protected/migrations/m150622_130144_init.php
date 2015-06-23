<?php

class m150622_130144_init extends CDbMigration
{
	public function up()
	{
		$this->createTable('users', array(
			'id' => 'pk',
			'username' => 'string NOT NULL',
			'password' => 'string NOT NULL',
			'salt' => 'string NOT NULL',
		));
		$this->createTable('files', array(
			'id' => 'pk',
			'filename' => 'string NOT NULL',
		));
        $this->createIndex('filename', 'files', 'filename', true);
	}

	public function down()
	{
        $this->dropTable('files');
        $this->dropTable('users');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}