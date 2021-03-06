<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name')->unique();
          $table->string('acronym')->unique()->nullable();
          $table->text('description')->nullable();
          $table->string('url')->nullable();
          $table->date('anniversary')->nullable();
          $table->enum('status', ['active', 'inactive'])->default('active');
          $table->string('logo')->default('ship.jpg');
          $table->string('color')->nullable();
          $table->timestamps();
          $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organizations');
    }
}
