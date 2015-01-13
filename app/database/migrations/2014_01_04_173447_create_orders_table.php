<?php

use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function($table)
		{
			$table->increments('id');
			$table->text('items');
			$table->integer('price')->index()->unsigned();
			$table->integer('user_id')->index()->unsigned();
			$table->datetime('eta');
			$table->integer('location_id')->index()->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}

}