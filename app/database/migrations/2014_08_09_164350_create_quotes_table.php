<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('quotes', function($table)
		{
			$table->increments('id');
			$table->unsignedInteger('user_id');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
			$table->string('title', 32);
			$table->longText('quote');
			$table->tinyInteger('status');
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
		Schema::drop('quotes');
	}

}
