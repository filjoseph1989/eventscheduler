<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_attendances', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('event_id')->unsigned()->index();
          $table->integer('user_id')->unsigned()->index();
          $table->string('reason')->nullable();
          $table->enum('status', ['true', 'false'])->default('false');
          $table->enum('confirmation', ['true', 'false'])->default('false');
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
