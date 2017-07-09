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
            $table->integer('event_type_id')->unsigned()->index();
            $table->integer('event_category_id')->unsigned()->index();
            $table->integer('organization_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->string('event');
            $table->text('description');
            $table->date('date_start');
            $table->date('date_end');
            $table->time('date_start_time');
            $table->time('date_end_time');
            $table->integer('whole_day');
            $table->string('venue')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('deleted_or_not')->default(1);
            $table->timestamps();

            # Foreign keys
            $table->foreign('event_type_id')->references('id')->on('event_types');
            $table->foreign('event_category_id')->references('id')->on('event_categories');
            $table->foreign('organization_id')->references('id')->on('organizations');
            $table->foreign('user_id')->references('id')->on('users');
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
