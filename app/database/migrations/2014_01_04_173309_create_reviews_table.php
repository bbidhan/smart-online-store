<?php

use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration {

	public function up()
	{
		Schema::create('reviews', function($table)
		{
			$table->increments('id');
			$table->string('title');
			$table->text('description');
			$table->integer('user_id')->index()->unsigned();
			$table->integer('product_id')->index()->unsigned();
			$table->integer('rating')->index()->unsigned();
			$table->integer('thumbsup')->unsigned()->nullable();
			$table->integer('thumbsdown')->unsigned()->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('reviews');
	}

}