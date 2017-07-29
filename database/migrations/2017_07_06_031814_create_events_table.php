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
            $table->integer('event_type_id')->unsigned()->index();
            $table->integer('event_category_id')->unsigned()->index();
            $table->integer('organization_id')->unsigned()->index();
            $table->string('title');
            $table->text('description');
            $table->string('venue');
            $table->date('date_start')->useCurrent();
            $table->date('date_end')->nullable();
            $table->time('date_start_time')->default('00:00:00');
            $table->time('date_end_time')->nullable()->default('00:00:00');
            $table->integer('whole_day');
            $table->enum('status', ['upcoming', 'on-going', 'canceled', 'archived'])->default('upcoming');
            $table->enum('semester', ['first', 'second']);
            $table->integer('approver_count')->default(0);
            $table->enum('notify_via_twitter', ['on','off'])->default('off');
            $table->enum('notify_via_facebook', ['on','off'])->default('off');
            $table->enum('notify_via_sms', ['on','off'])->default('off');
            $table->enum('notify_via_email', ['on','off'])->default('off');
            $table->string('additional_msg_facebook')->nullable();
            $table->string('additional_msg_sms')->nullable();
            $table->string('additional_msg_email')->nullable();
            $table->string('picture_facebook')->nullable();
            $table->string('picture_twitter')->nullable();
            $table->string('picture_email')->nullable();
            $table->timestamps();
            $table->softDeletes();

            # Foreign keys
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('event_type_id')->references('id')->on('event_types');
            $table->foreign('event_category_id')->references('id')->on('event_categories');
            $table->foreign('organization_id')->references('id')->on('organizations');
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
