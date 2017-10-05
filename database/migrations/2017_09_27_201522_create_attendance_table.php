<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id')->unsigned()->index();
          $table->integer('event_id')->unsigned()->index();
          $table->enum('status', ['confirmed', 'unconfirmed', 'declined'])->default('unconfirmed');
          $table->enum('did_attend', ['true', 'false'])->default('false');
          $table->string('reason')->nullable();
          $table->softDeletes();
          $table->timestamps();

          #foreign keys
          $table->foreign('user_id')->references('id')->on('users');
          $table->foreign('event_id')->references('id')->on('events');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_attendance');
    }
}
