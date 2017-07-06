<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_admins', function (Blueprint $table) {
          $table->increments('id');
          $table->string('account_number', '20')->unique();
          $table->string('email')->unique();
          $table->string('password');
          $table->string('first_name');
          $table->string('last_name');
          $table->string('middle_name');
          $table->string('suffix_name', '10')->nullable();
          $table->string('facebook_username')->unique()->nullable();
          $table->string('twitter_username')->unique()->nullable();
          $table->string('instagram_username')->unique()->nullable();
          $table->string('mobile_number', '12');
          $table->tinyInteger('status')->default(0);
          $table->rememberToken();
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
        Schema::dropIfExists('s_admins');
    }
}
