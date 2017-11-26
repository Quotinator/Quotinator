<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenamePasswordRemindersPasswordResetsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      Schema::rename('password_reminders', 'password_resets');
      Schema::table('password_resets', function (Blueprint $table) {
          $table->dropIndex('password_reminders_token_index');
          $table->string('created_at')->nullable()->change();
          $table->renameColumn('created_at', 'create_at');
      });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::rename('password_resets', 'password_reminders');
    Schema::table('password_reminders', function (Blueprint $table) {
        $table->renameColumn('create_at', 'created_at');
        $table->string('create_at')->nullable(false)->change();
        $table->index('token');
    });
  }
}
