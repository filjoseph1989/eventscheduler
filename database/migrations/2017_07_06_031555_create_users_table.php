<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     *
     *
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('course_id')->unsigned()->index();
          $table->string('full_name');
          $table->string('account_number')->unique(); //student_number or employee number
          $table->integer('user_type_id')->unsigned()->index(); 
          $table->string('email')->unique();
          $table->string('password');
          $table->string('facebook')->nullable()->unique();
          $table->string('twitter')->nullable()->unique();
          $table->string('mobile_number', '12');
          $table->string('picture')->default('profile.png');
          $table->enum('status', ['true', 'false'])->default('false');
          $table->enum('is_approver', ['true', 'false'])->default('false');
          $table->rememberToken();
          $table->timestamps();
          $table->softDeletes();




          #foreign keys
          $table->foreign('user_type_id')->references('id')->on('user_accounts');
          $table->foreign('course_id')->references('id')->on('courses');
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
