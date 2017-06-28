<?php

use App\Models\User;
use Carbon\Carbon;
use Faker\Factory as Faker;
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
        $faker = Faker::create();
        for ($i=0; $i < 50; $i++) {
            $gender = ['male','female'];
            User::create([
                'user_account_id'    => $faker->numberBetween($min = 1, $max = 6),
                'course_id'          => $faker->numberBetween($min = 1, $max = 9),
                'department_id'      => $faker->numberBetween($min = 1, $max = 4),
                'position_id'        => $faker->numberBetween($min = 1, $max = 13),
                'account_number'     => $faker->numberBetween($min = 1000, $max = 9000),
                'first_name'         => $faker->firstName($gender),
                'last_name'          => $faker->lastName,
                'middle_name'        => ucfirst(substr($faker->firstName($gender), 3, 1)),
                'suffix_name'        => ucfirst($faker->suffix),
                'email'              => $faker->email,
                'password'           => bcrypt('password'),
                'facebook_username'  => $faker->lastName."@facebook.com",
                'twitter_username'   => $faker->lastName.'@twitter.com',
                'instagram_username' => $faker->lastName.'@instagram.com',
                'mobile_number'      => $faker->numberBetween($min = 1000, $max = 9000),
                'status'             => '0',
                'remember_token'     => NULL
            ]);
        }
    }
}
