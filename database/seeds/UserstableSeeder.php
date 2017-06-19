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
      array(
        'user_account_id'    => '1',
        'course_id'          => '1',
        'department_id'      => '2',
        'position_id'        => '8',
        'account_number'     => '1',
        'email'              => 'liz@email.com',
        'password'           => bcrypt('password'),
        'first_name'         => 'Liz',
        'last_name'          => 'Dee',
        'middle_name'        => 'G',
        'suffix_name'        => NULL,
        'facebook_email'     => 'liz@facebook.com',
        'twitter_username'   => 'liz@twitter.com',
        'instagram_username' => 'liz@instagram.com',
        'contact_number'     => '09128633866',
        'status'             => '1',
        'remember_token'     => NULL,
        'created_at'         => date('Y-m-d H:i:s'),
        'updated_at'         => date('Y-m-d H:i:s')
      )
    ]);
  }
}
