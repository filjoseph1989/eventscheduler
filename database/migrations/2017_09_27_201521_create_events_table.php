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
            $table->integer('user_id')->unsigned()->index();
            $table->integer('organization_id')->unsigned()->index()->nullable(); //made nullable for osa users
            $table->integer('event_type_id')->unsigned()->index();
            $table->enum('category', ['within','personal','university','organization'])->nullable();
            $table->string('title'); //this is not unique because there are events with same titles at both semesters
            $table->text('description');
            $table->string('venue');
            $table->date('date_start');
            $table->date('date_end')->nullable();
            $table->time('date_start_time')->default('00:00:00');
            $table->time('date_end_time')->nullable()->default('00:00:00');
            $table->enum('whole_day', ['true', 'false'])->default('false'); ///for the purpose of a calendar's functionality
            $table->enum('status', ['new', 'requested', 'upcoming', 'on-going', 'canceled', 'archived'])->default('new');
            $table->enum('is_approve', ['true', 'false'])->default('false');
            $table->enum('twitter', ['on','off'])->default('off');
            $table->enum('facebook', ['on','off'])->default('off');
            $table->string('facebook_msg')->nullable();
            $table->enum('sms', ['on','off'])->default('off');
            $table->string('sms_msg')->nullable();
            $table->enum('email', ['on','off'])->default('off');
            $table->string('email_msg')->nullable();
            $table->string('img')->nullable();
            $table->timestamps();
            $table->softDeletes();

            # Foreign keys
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('organization_id')->references('id')->on('organizations');
            $table->foreign('event_type_id')->references('id')->on('event_types');
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
