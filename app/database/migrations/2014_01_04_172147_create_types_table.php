<?php

use Illuminate\Database\Migrations\Migration;

class CreateTypesTable extends Migration {

	public function up()
	{
		Schema::create('types', function($table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('description');
		});
	}

	public function down()
	{
		Schema::drop('types');
	}

}