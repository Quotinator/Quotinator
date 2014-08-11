<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionRankTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('permission_rank', function($table)
		{
			$table->unsignedInteger('rank_id');
			$table->foreign('rank_id')->references('id')->on('ranks')->onDelete('cascade')->onUpdate('cascade');
			$table->unsignedInteger('permission_id');
			$table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('permission_rank');
	}

}
