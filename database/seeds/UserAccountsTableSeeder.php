<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserAccountsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
   public function run()
   {
       DB::table('user_accounts')->insert([
         array(
           'name'           => 'admin',
           'theme'          => 'theme-grey',
           'color'          => 'bg-grey',
           'created_at' => Carbon::now()->toDateTimeString(),
           'updated_at' => Carbon::now()->toDateTimeString(),
         ),
         array(
           'name'           => 'organization-adviser',
           'theme'          => 'theme-teal',
           'color'          => 'bg-teal',
           'created_at' => Carbon::now()->toDateTimeString(),
           'updated_at' => Carbon::now()->toDateTimeString(),
         ),
         array(
           'name'           => 'organization-head',
           'theme'          => 'theme-brown',
           'color'          => 'bg-brown',
           'created_at' => Carbon::now()->toDateTimeString(),
           'updated_at' => Carbon::now()->toDateTimeString(),
         ),
         array(
           'name'           => 'organization-member',
           'theme'          => 'theme-blue-grey',
           'color'          => 'bg-blue-grey',
           'created_at' => Carbon::now()->toDateTimeString(),
           'updated_at' => Carbon::now()->toDateTimeString(),
         ),
         array(
           'name'           => 'osa-personnel',
           'theme'          => 'theme-purple',
           'color'          => 'bg-purple',
           'created_at' => Carbon::now()->toDateTimeString(),
           'updated_at' => Carbon::now()->toDateTimeString(),
         ),
         array(
           'name'           => 'organization-co-adviser',
           'theme'          => 'theme-green',
           'color'          => 'bg-green',
           'created_at' => Carbon::now()->toDateTimeString(),
           'updated_at' => Carbon::now()->toDateTimeString(),
         ),
         array(
           'name'           => 'university-staff',
           'theme'          => 'theme-lime',
           'color'          => 'bg-lime',
           'created_at' => Carbon::now()->toDateTimeString(),
           'updated_at' => Carbon::now()->toDateTimeString(),
         )
       ]);
   }
}
