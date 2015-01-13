<?php

use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration {

	public function up()
	{
		Schema::create('admins', function($table)
		{
			$table->increments('id');
			$table->string('firstname');
			$table->string('lastname');
			$table->string('phone');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('admins');
	}

}