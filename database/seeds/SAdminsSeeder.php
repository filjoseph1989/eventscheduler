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
                'suffix_name'        => 'A',
                'facebook_username'  => 'admin@facebook',
                'twitter_username'   => 'admin@twitter.com',
                'instagram_username' => 'admin@instagram.com',
                'mobile_number'      => '09121234567',
                'mobile_number'      => '958633866',
                'remember_token'     => NULL,
                'created_at'         => date('Y-m-d H:i:s'),
                'updated_at'         => date('Y-m-d H:i:s')
            ),
            array(
                'account_number'     => '1',
                'email'              => 'admin@email.com',
                'password'           => bcrypt('password'),
                'first_name'         => 'Admin',
                'last_name'          => 'Admin',
                'middle_name'        => 'A',
                'suffix_name'        => 'A',
                'facebook_username'  => 'admin@facebook',
                'twitter_username'   => 'admin@twitter.com',
                'instagram_username' => 'admin@instagram.com',
                'mobile_number'      => '09121234567',
                'status'             => '1',
                'remember_token'     => NULL,
                'created_at'         => date('Y-m-d H:i:s'),
                'updated_at'         => date('Y-m-d H:i:s')
            )
        ]);
    }
}
