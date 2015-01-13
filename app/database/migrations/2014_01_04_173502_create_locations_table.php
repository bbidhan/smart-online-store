<?php

use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration {

	public function up()
	{
		Schema::create('locations', function($table)
		{
			$table->increments('id');
			$table->string('name');
			$table->float('longitude');
			$table->float('latitude');
		});
	}

	public function down()
	{
		Schema::drop('locations');
	}

}