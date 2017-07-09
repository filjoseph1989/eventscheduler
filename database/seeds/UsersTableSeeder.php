<?php

use Carbon\Carbon;
use App\Models\User;
use Faker\Factory as Faker;
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
        $faker = Faker::create();
        for ($i=0; $i < 20; $i++) {
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

            /**
             * Save the generated data to database
             */
            User::create([
                'user_account_id'    => $faker->numberBetween($min = 1, $max = 5),
                'course_id'          => $faker->numberBetween($min = 1, $max = 9),
                'department_id'      => $faker->numberBetween($min = 1, $max = 4),
                'position_id'        => $faker->numberBetween($min = 1, $max = 13),
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
                'deleted_or_not'     => 1,
                'remember_token'     => NULL
            ]);
        }

        /**
         * Additional default data
         */
         User::create([
            'user_account_id'    => 1,
            'course_id'          => 1,
            'department_id'      => 1,
            'position_id'        => 1,
            'account_number'     => '0000-00001',
            'first_name'         => 'not user',
            'last_name'          => '01',
            'middle_name'        => '',
            'suffix_name'        => '',
            'email'              => 'user@email.com',
            'password'           => bcrypt('password'),
            'facebook_username'  => 'user@email.com',
            'twitter_username'   => 'user@email.com',
            'instagram_username' => 'user@email.com',
            'mobile_number'      => '9958633866',
            'status'             => 1,
            'deleted_or_not'     => 1,
            'remember_token'     => NULL
        ]);
    }
}