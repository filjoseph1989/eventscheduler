<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('subscriptions', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name');
      $table->string('email'); //ask if we can make this nullable
      $table->string('contact_number'); //ask if we can make this nullable
      $table->string('facebook')->nullable(); //ask if we can make this nullable
      $table->string('twitter')->nullable(); //ask if we can make this nullable
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
      Schema::dropIfExists('subscriptions');
  }
}
