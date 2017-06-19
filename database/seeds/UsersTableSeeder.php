<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
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
        'user_account_id' => '1',
        'course_id'       => '1',
        'department_id'   => '1',
        'position_id'     => '1',
        'account_number'  => '2012-45678',
        'email'           => 'user@email.com',
        'password'        => bcrypt('password'),
        'first_name'      => 'John',
        'last_name'       => 'Doe',
        'middle_name'     => 'Doe',
        'suffix_name'     => 'Jr.',
        'email'           => 'user@email.com',
        'facebook_email'  => 'user@email.com',
        'twitter_username'=> 'user@email.com',
        'instagram_username'=> 'user@email.com',
        'contact_number'  => '09121234567',
        'status'          => '1',
        'created_at'      => date('Y-m-d H:i:s'),
        'updated_at'      => date('Y-m-d H:i:s')
      )
    ]);
  }
}
