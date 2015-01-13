<?php

use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration {

	public function up()
	{
		Schema::create('customers', function($table)
		{
			$table->increments('id');
			$table->string('firstname');
			$table->string('lastname');
			$table->string('phone');
			$table->integer('type_id')->index()->unsigned()->default(0);
			$table->text('wishlist')->nullable();
			$table->text('cart')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('customers');
	}

}