<?php

use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	public function up()
	{
		Schema::create('products', function($table)
		{
			$table->increments('id');
			$table->string('name');
			$table->text('description');
			$table->integer('price')->index()->unsigned();
			$table->integer('discount')->index()->unsigned()->default(0);
			$table->integer('stock')->index()->unsigned();
			$table->integer('vendor_id')->index()->unsigned();
			$table->integer('category_id')->index()->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('products');
	}

}