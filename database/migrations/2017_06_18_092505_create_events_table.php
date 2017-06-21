<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->integer('event_type_id')->unsigned()->index();
          $table->foreign('event_type_id')->references('id')->on('event_types');
          $table->integer('event_category_id')->unsigned()->index();
          $table->foreign('event_category_id')->references('id')->on('event_categories');
          $table->date('date');
          $table->time('time');
          $table->string('venue')->nullable();
          $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('events');
    }
}
