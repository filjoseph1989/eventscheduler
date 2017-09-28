<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_type_id')->unsigned()->index();
            $table->integer('event_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->integer('organization_id')->unsigned()->index();
            $table->enum('category', ['within', 'personal', 'university', 'organization']);
            $table->timestamps();
            $table->softDeletes();

            #foreign keys
            $table->foreign('event_type_id')->references('id')->on('event_types');
            $table->foreign('event_id')->references('id')->on('events');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('events_groups');
    }
}
