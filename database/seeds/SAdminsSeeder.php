<?php

use Illuminate\Database\Seeder;

class SAdminsSeeder extends Seeder
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
              'account_number'     => '2012-35943',
              'email'              => 'liz@email.com',
              'password'           => bcrypt('password'),
              'first_name'         => 'Liz',
              'last_name'          => 'de Guzman',
              'middle_name'        => 'Nawa',
              'suffix_name'        => '',
              'facebook_username'  => 'jlvoice777@facebook.com',
              'twitter_username'   => 'lizdodiz',
              'instagram_username' => 'lizdodiz',
              'mobile_number'      => '958633866',
              'status'             => '1',
              'remember_token'     => NULL
          )
      ]);
    }
}
