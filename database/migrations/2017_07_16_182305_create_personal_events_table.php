<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_type_id')->unsigned()->index();
            $table->integer('event_category_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->integer('calendar_id')->unsigned()->index();
            $table->string('event');
            $table->text('description');
            $table->string('venue');
            $table->date('date_start')->useCurrent();
            $table->date('date_end')->useCurrent();
            $table->time('date_start_time')->default('00:00:00');
            $table->time('date_end_time')->default('00:00:00');
            $table->integer('whole_day');
            $table->tinyInteger('status')->default(0);
            $table->softDeletes();
            $table->timestamps();

            # Foreign keys
            $table->foreign('event_type_id')->references('id')->on('event_types');
            $table->foreign('event_category_id')->references('id')->on('event_categories');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('calendar_id')->references('id')->on('calendars');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_events');
    }
}