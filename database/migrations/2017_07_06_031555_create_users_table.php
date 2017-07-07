<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_account_id')->unsigned()->index();
          $table->foreign('user_account_id')->references('id')->on('user_accounts');
          $table->integer('course_id')->unsigned()->index();
          $table->foreign('course_id')->references('id')->on('courses');
          $table->integer('department_id')->unsigned()->index();
          $table->foreign('department_id')->references('id')->on('departments');
          $table->integer('position_id')->unsigned()->index();
          $table->foreign('position_id')->references('id')->on('positions');
          $table->string('account_number')->unique();
          $table->string('email')->unique();
          $table->string('password');
          $table->string('first_name');
          $table->string('last_name');
          $table->string('middle_name', '10')->nullable();
          $table->string('suffix_name', '10')->nullable();
          $table->string('facebook_username')->nullable()->unique();
          $table->string('twitter_username')->nullable()->unique();
          $table->string('instagram_username')->nullable()->unique();
          $table->string('mobile_number', '12');
          $table->tinyInteger('status')->default(0);
          $table->tinyInteger('deleted_or_not')->default(1);
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
        Schema::dropIfExists('users');
    }
}