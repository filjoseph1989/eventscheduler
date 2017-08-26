<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_groups', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id')->unsigned()->index();
          $table->integer('organization_id')->unsigned()->index();
          $table->integer('position_id')->default()->unsigned()->index();
          $table->enum('membership_status', ['yes', 'no'])->default('no');
          $table->timestamps();
          $table->softDeletes();

          #foreign keys
          $table->foreign('user_id')->references('id')->on('users');
          $table->foreign('organization_id')->references('id')->on('organizations');
          $table->foreign('position_id')->references('id')->on('positions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organization_groups');
    }
}
