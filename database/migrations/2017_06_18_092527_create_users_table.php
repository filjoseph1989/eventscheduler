<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_account_id')->unsigned()->index();
            $table->foreign('user_account_id')->references('id')->on('user_accounts');
            $table->integer('course_id')->unsigned()->index();
            $table->foreign('course_id')->references('id')->on('courses');
            $table->integer('department_id')->unsigned()->index();
            $table->foreign('department_id')->references('id')->on('departments');
            $table->integer('position_id')->unsigned()->index();
            $table->foreign('position_id')->references('id')->on('positions');
            $table->string('account_number')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name', '10');
            $table->string('suffix_name')->nullable();
            $table->string('facebook_username')->unique()->nullable();
            $table->string('twitter_username')->unique()->nullable();
            $table->string('instagram_username')->unique()->nullable();
            $table->string('mobile_number', '12');
            $table->tinyInteger('status')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
        `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    	`user_account_id` INT(10) UNSIGNED NOT NULL,
    	`course_id` INT(10) UNSIGNED NOT NULL,
    	`department_id` INT(10) UNSIGNED NOT NULL,
    	`position_id` INT(10) UNSIGNED NOT NULL,
    	`account_number` VARCHAR(191) NOT NULL COLLATE 'utf8mb4_unicode_ci',
    	`email` VARCHAR(191) NOT NULL COLLATE 'utf8mb4_unicode_ci',
    	`password` VARCHAR(191) NOT NULL COLLATE 'utf8mb4_unicode_ci',
    	`first_name` VARCHAR(191) NOT NULL COLLATE 'utf8mb4_unicode_ci',
    	`last_name` VARCHAR(191) NOT NULL COLLATE 'utf8mb4_unicode_ci',
    	`middle_name` VARCHAR(191) NOT NULL COLLATE 'utf8mb4_unicode_ci',
    	`suffix_name` VARCHAR(10) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
    	`facebook_username` VARCHAR(191) NOT NULL COLLATE 'utf8mb4_unicode_ci',
    	`twitter_username` VARCHAR(191) NOT NULL COLLATE 'utf8mb4_unicode_ci',
    	`instagram_username` VARCHAR(191) NOT NULL COLLATE 'utf8mb4_unicode_ci',
    	`mobile_number` VARCHAR(12) NOT NULL COLLATE 'utf8mb4_unicode_ci',
    	`status` TINYINT(4) NOT NULL DEFAULT '0',
    	`remember_token` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
    	`created_at` TIMESTAMP NULL DEFAULT NULL,
    	`updated_at` TIMESTAMP NULL DEFAULT NULL,
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
