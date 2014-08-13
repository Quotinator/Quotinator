<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavoritesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('favorites', function($table)
		{
			$table->unsignedInteger('user_id');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
			$table->unsignedInteger('quote_id');
			$table->foreign('quote_id')->references('id')->on('quotes')->onDelete('cascade')->onUpdate('cascade');
			$table->primary(array('user_id', 'quote_id'));
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('favorites');
	}

}
