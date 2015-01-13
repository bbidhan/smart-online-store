<?php

use Illuminate\Database\Migrations\Migration;

class CreateVendorsTable extends Migration {

	public function up()
	{
		Schema::create('vendors', function($table)
		{
			$table->increments('id');
			$table->string('name');
			$table->text('description');
			$table->string('address');
			$table->string('phone');
			$table->integer('discount')->index()->unsigned()->default(0);
			$table->integer('location_id')->index()->unsigned()->default(0);

			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('vendors');
	}

}