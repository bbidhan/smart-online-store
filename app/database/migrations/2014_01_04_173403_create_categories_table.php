<?php

use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration {

	public function up()
	{
		Schema::create('categories', function($table)
		{
			$table->increments('id');
			$table->integer('parent_id')->index()->unsigned();
			$table->string('name');
		});
	}

	public function down()
	{
		Schema::drop('categories');
	}

}