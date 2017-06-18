<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('organizations', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name');
      $table->tinyInteger('status');
      $table->date('date_started')->default(date("Y-m-d H:i:s"));
      $table->date('date_expired')->default(date("Y-m-d H:i:s"));
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
      Schema::dropIfExists('organizations');
  }
}
