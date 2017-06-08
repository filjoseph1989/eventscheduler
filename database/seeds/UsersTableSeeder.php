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
        'course_id'       => '43',
        'department_id'   => '1',
        'position_id'     => '1',
        'first_name'      => 'John',
        'last_name'       => 'Doe',
        'middle_name'     => 'Doe',
        'suffix_name'     => '',
        'email'           => 'john@email.com',
        'contact_number'  => '09121234567',
        'password'        => bcrypt('password'),
        'status'          => '1',
        'created_at'      => date('Y-m-d H:i:s'),
        'updated_at'      => date('Y-m-d H:i:s')
      )
    ]);
  }
}
