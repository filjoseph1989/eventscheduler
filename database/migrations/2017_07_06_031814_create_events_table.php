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
            $table->string('title');
            $table->text('description');
            $table->string('venue');
            $table->date('date_start')->useCurrent();
            $table->date('date_end')->nullable();
            $table->time('date_start_time')->default('00:00:00');
            $table->time('date_end_time')->nullable()->default('00:00:00');
            $table->enum('whole_day', ['true'. 'false'])->default('false');
            $table->integer('event_type_id')->unsigned()->index();
            $table->enum('status', ['upcoming', 'on-going', 'canceled', 'archived'])->default('upcoming');
            $table->enum('is_approve', ['true', 'false'])->default('false');
            $table->enum('semester', ['first', 'second']);
            $table->enum('twitter', ['on','off'])->default('off');
            $table->string('twitter_message')->nullable();
            $table->string('twitter_img')->nullable();
            $table->enum('facebook', ['on','off'])->default('off');
            $table->string('facebook_message')->nullable();
            $table->string('facebook_img')->nullable();
            $table->enum('sms', ['on','off'])->default('off');
            $table->string('sms_message')->nullable();
            $table->enum('email', ['on','off'])->default('off');
            $table->string('email_message')->nullable();
            $table->string('email_img')->nullable();
            $table->timestamps();
            $table->softDeletes();

            # Foreign keys
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
