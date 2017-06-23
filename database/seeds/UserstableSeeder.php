<?php

use Illuminate\Database\Seeder;

class UserstableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('users')->insert([
        array
        (   'user_account_id'    => '1',
            'course_id'          => '9',
            'department_id'      => '2',
            'position_id'        => '8',
            'account_number'     => '2012-35943',
            'email'              => 'user@email.com',
            'password'           => bcrypt('password'),
            'first_name'         => 'user',
            'last_name'          => 'user',
            'middle_name'        => 'i',
            'suffix_name'        => 'i',
            'facebook_username'  => 'user@facebook.com',
            'twitter_username'   => 'user@twitter.com',
            'instagram_username' => 'user@instagram.com',
            'mobile_number'      => '429496729', //5
            'status'             => '1',
            'remember_token'     => NULL
        )
    ]);
  }
}
