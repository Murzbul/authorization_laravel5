<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesHasActions extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      Schema::create('roles_has_actions', function(Blueprint $table)
      {
          $table->integer('role_id')->unsigned()->index();
          $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
          $table->integer('action_id')->unsigned()->index();
          $table->foreign('action_id')->references('id')->on('actions')->onDelete('cascade');
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
      Schema::drop('roles_has_actions');
  }
}
