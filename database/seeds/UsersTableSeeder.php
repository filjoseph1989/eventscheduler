<?php

use Carbon\Carbon;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;


class UsersTableSeeder extends Seeder
{
  public function run()
  {
      $faker = Faker::create();
      for ($i=0; $i < 20; $i++)
      {
          $gender = ['male','female'];
          /**
           * Genarate the following used for seeding
           *  1. email
           *  2. account_number
           *  3. facebook_username
           *  4. instagram_username
           *  5. twitter_username
           */
          email:
          $email = $faker->email;
          account_number:
          $account_number = "2017-" . $faker->numberBetween($min = 10000, $max = 90000);
          facebook_username:
          $facebook_username = $faker->lastName."@facebook.com";
          twitter_username:
          $twitter_username = $faker->lastName."@twitter.com";
          instagram_username:
          $instagram_username = $faker->lastName."@instagram.com";

          /**
           * Check if the following are already in the Database
           *  1. email
           *  2. account_number
           *  3. facebook_username
           *  4. instagram_username
           *  5. twitter_username
           *
           * if yes, generate again
           */
          if (User::where('email', '=', $email)->exists()) {
              goto email;
          }
          if (User::where('account_number', '=', $account_number)->exists()) {
              goto account_number;
          }
          if (User::where('facebook_username', '=', $facebook_username)->exists()) {
              goto facebook_username;
          }
          if (User::where('twitter_username', '=', $twitter_username)->exists()) {
              goto twitter_username;
          }
          if (User::where('instagram_username', '=', $instagram_username)->exists()) {
              goto instagram_username;
          }
          User::create([
               'user_account_id'    => $faker->numberBetween($min = 1, $max = 5),
               'course_id'          => $faker->numberBetween($min = 1, $max = 9),
               'department_id'      => $faker->numberBetween($min = 1, $max = 4),
               'account_number'     => $account_number,
               'first_name'         => $faker->firstName($gender),
               'last_name'          => $faker->lastName,
               'middle_name'        => ucfirst(substr($faker->firstName($gender), 3, 1)),
               'suffix_name'        => ucfirst($faker->suffix),
               'email'              => $email,
               'password'           => bcrypt($account_number),
               'facebook_username'  => $facebook_username,
               'twitter_username'   => $twitter_username,
               'instagram_username' => $instagram_username,
               'mobile_number'      => $faker->numberBetween($min = 1000, $max = 9000),
               'status'             => 0,
               'remember_token'     => NULL
           ]);
      }
      DB::table('users')->insert([
        array(
              'user_account_id'    => 1,
              'course_id'          => 1,
              'department_id'      => 1,
              'account_number'     => '0000000001',
              'first_name'         => 'Administrator',
              'last_name'          => 'User',
              'middle_name'        => '',
              'suffix_name'        => '',
              'email'              => 'adminuser@email.com',
              'password'           => bcrypt('password'),
              'facebook_username'  => 'adminuser@email.com',
              'twitter_username'   => 'adminuser@email.com',
              'instagram_username' => 'adminuser@email.com',
              'mobile_number'      => '9958633866',
              'status'             => 1,
              'remember_token'     => NULL
          ),
          array(
            'user_account_id'    => 2,
            'course_id'          => 1,
            'department_id'      => 2,
            'account_number'     => '0000000002',
            'first_name'         => 'Org Adviser',
            'last_name'          => 'User',
            'middle_name'        => '',
            'suffix_name'        => '',
            'email'              => 'adviseruser@email.com',
            'password'           => bcrypt('password'),
            'facebook_username'  => 'adviseruser@email.com',
            'twitter_username'   => 'adviseruser@email.com',
            'instagram_username' => 'adviseruser@email.com',
            'mobile_number'      => '9958633866',
            'status'             => 1,
            'remember_token'     => NULL
          ),
          array(
            'user_account_id'    => 3,
                'course_id'          => 6,
                'department_id'      => 2,
                'account_number'     => '20XX-00001',
                'first_name'         => 'Org Head',
                'last_name'          => 'User',
                'middle_name'        => '',
                'suffix_name'        => '',
                'email'              => 'headuser@email.com',
                'password'           => bcrypt('password'),
                'facebook_username'  => 'headuser@email.com',
                'twitter_username'   => 'headuser@email.com',
                'instagram_username' => 'headuser@email.com',
                'mobile_number'      => '9958633866',
                'status'             => 1,
                'remember_token'     => NULL
          ),
          array(
            'user_account_id'    => 4,
            'course_id'          => 6,
            'department_id'      => 2,
            'account_number'     => '20XX-00002',
            'first_name'         => 'Org Member',
            'last_name'          => 'User',
            'middle_name'        => '',
            'suffix_name'        => '',
            'email'              => 'memberuser@email.com',
            'password'           => bcrypt('password'),
            'facebook_username'  => 'memberuser@email.com',
            'twitter_username'   => 'memberuser@email.com',
            'instagram_username' => 'memberuser@email.com',
            'mobile_number'      => '9958633866',
            'status'             => 1,
            'remember_token'     => NULL
          ),
          array(
            'user_account_id'    => 5,
                  'course_id'          => 1,
                  'department_id'      => 1,
                  'account_number'     => '0000000003',
                  'first_name'         => 'Osa Personnel',
                  'last_name'          => 'User',
                  'middle_name'        => '',
                  'suffix_name'        => '',
                  'email'              => 'osauser@email.com',
                  'password'           => bcrypt('password'),
                  'facebook_username'  => 'osauser@email.com',
                  'twitter_username'   => 'osauser@email.com',
                  'instagram_username' => 'osauser@email.com',
                  'mobile_number'      => '9958633866',
                  'status'             => 1,
                  'remember_token'     => NULL
          ),
      ]);
  }
}
