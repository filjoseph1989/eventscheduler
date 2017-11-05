<?php

use Carbon\Carbon;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UsersTableSeeder0 extends Seeder
{
  /**
   * Mobile prefix
   * @var string
   */
  private $mobilePrefix = [
    '915',	'927',	'995',	'938',	'919',	'813',	'913',	'981',	'934',	'922',
    '917',	'935',	'817',	'939',	'921',	'907',	'914',	'998',	'941',	'923',
    '945',	'936',	'905',	'940',	'929',	'908',	'918',	'999',	'942',	'924',
    '955',	'976',	'906',	'946',	'989',	'909',	'928',	'951',	'943',	'931',
    '956',	'997',	'916',	'948',	'920',	'910',	'947',	'912',	'944',	'932',
    '994',	'975',	'926',	'950',	'930',	'911',	'949',	'970',	'925',	'933',
    '992',  '977',	'978',  '979',	'996',  '937',  '973',  '974'
  ];

  /**
   * Seeder run
   *
   * @return void
   */
  public function run()
  {
      $faker = Faker::create();

      $facebook = strtolower("{$faker->name}@facebook.com");
      $facebook = str_replace(' ', '', $facebook);
      $twitter  = strtolower("@{$faker->name}");
      $twitter  = str_replace(' ', '', $twitter);

      User::create([
        'course_id'      => $faker->numberBetween($min = 1, $max = 9),
        'full_name'      => ucfirst(substr($faker->name(['male','female']), 0)),
        'account_number' => "2017-" . $faker->numberBetween($min = 10000, $max = 90000),
        'user_type_id'   => '3', # Osa directly
        'email'          => 'default_user@email.com',
        'password'       => bcrypt($account_number),
        'facebook'       => $facebook,
        'twitter'        => $twitter,
        'mobile_number'  => "63" . $this->mobilePrefix[array_rand($this->mobilePrefix, 1)] . $faker->numberBetween($min = 1000000, $max = 9000000),
      ]);
  }
}
