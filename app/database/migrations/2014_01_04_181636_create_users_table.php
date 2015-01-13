<?php

use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	public function up()
	{
		Schema::create('users', function($table)
		{
			$table->increments('id');
			$table->string('email')->unique();
			$table->string('username')->unique();
			$table->string('password');
			$table->integer('role_id')->index();
			$table->string('role_type');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('users');
	}

}