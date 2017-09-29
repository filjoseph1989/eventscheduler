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
      for ($i = 0 ; $i < 10; $i++)
      {
          $gender  =  ['male','female'];
          /**
           * Genarate the following used for seeding
           *  1. email
           *  2. account_number
           *  3. facebook
           *  4. twitter
           */
          email                     :  
            $email                  =  $faker->email;
          account_number            :  
            $account_number         =  "2017-" . $faker->numberBetween($min = 10000, $max = 90000);
          facebook                  :  
            $facebook               =  $faker->name."@facebook.com";
          twitter                   :  
            $twitter                =  $faker->name."@twitter.com";

          /**
           * Check if the following are already in the Database
           *  1. email
           *  2. account_number
           *  3. facebook
           *  4. twitter
           *
           * if yes, generate again
           */
          if (User::where('email', '=', $email)->exists()) {
              goto email;
          }
          if (User::where('account_number', '=', $account_number)->exists()) {
              goto account_number;
          }
          if (User::where('facebook', '=', $facebook)->exists()) {
              goto facebook;
          }
          if (User::where('twitter', '=', $twitter)->exists()) {
              goto twitter;
          }
          User::create([
               'course_id'      => $faker->numberBetween($min = 1, $max = 9),
               'full_name'      => ucfirst(substr($faker->name($gender), 0)),
               'account_number' => $account_number,
               'user_type_id'   => $faker->numberBetween($min = 1, $max = 3),
               'email'          => $email,
               'password'       => bcrypt($account_number),
               'facebook'       => $facebook,
               'twitter'        => $twitter,
               'mobile_number'  => $faker->numberBetween($min = 1000, $max = 9000),
               'remember_token' => NULL
           ]);
      }
      DB::table('users')->insert([
          array(
                  'course_id'      => 1,
                  'full_name'      => 'Org Adviser',
                  'account_number' => '0000000002',
                  'user_type_id'   => 2,
                  'email'          => 'adviseruser@email.com',
                  'password'       => bcrypt('password'),
                  'facebook'       => 'adviseruser@email.com',
                  'twitter'        => 'adviseruser@email.com',
                  'mobile_number'  => '9958633866',
                  'remember_token' => NULL
          ),
          array(
                  'course_id'      => 6,
                  'full_name'      => 'Org Head',
                  'account_number' => '20XX-00001',
                  'user_type_id'   => 1,
                  'email'          => 'headuser@email.com',
                  'password'       => bcrypt('password'),
                  'facebook'       => 'headuser@email.com',
                  'twitter'        => 'headuser@email.com',
                  'mobile_number'  => '9958633866',
                  'remember_token' => NULL
          ),
          array(
                  'course_id'      => 6,
                  'full_name'      => 'Org Member',
                  'account_number' => '20XX-00002',
                  'user_type_id'   => 2,
                  'email'          => 'memberuser@email.com',
                  'password'       => bcrypt('password'),
                  'facebook'       => 'memberuser@email.com',
                  'twitter'        => 'memberuser@email.com',
                  'mobile_number'  => '9958633866',
                  'remember_token' => NULL
          ),
          array(
                  'course_id'      => 1,
                  'full_name'      => 'Osa Personnel',
                  'account_number' => '0000000003',
                  'user_type_id'   => 3,
                  'email'          => 'osauser@email.com',
                  'password'       => bcrypt('password'),
                  'facebook'       => 'osauser@email.com',
                  'twitter'        => 'osauser@email.com',
                  'mobile_number'  => '9958633866',
                  'remember_token' => NULL
          ),
      ]);
  }
}
