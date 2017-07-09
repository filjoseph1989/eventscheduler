<?php

use Illuminate\Database\Seeder;

class SAdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('s_admins')->insert([
          array(
              'account_number'     => '1',
              'email'              => 'admin@email.com',
              'password'           => bcrypt('password'),
              'first_name'         => 'Admin',
              'last_name'          => 'Admin',
              'middle_name'        => 'A',
              'suffix_name'        => 'A',
              'facebook_username'  => NULL,
              'twitter_username'   => NULL,
              'instagram_username' => NULL,
              'mobile_number'      => '',
              'status'             => '0',
              'remember_token'     => NULL,
              'created_at'         => date('Y-m-d H:i:s'),
              'updated_at'         => date('Y-m-d H:i:s')
          ),
      ]);
    }
}
