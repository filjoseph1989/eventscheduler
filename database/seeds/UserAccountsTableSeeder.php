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
           'deleted_or_not' => '1',
           'created_at' => Carbon::now()->toDateTimeString(),
           'updated_at' => Carbon::now()->toDateTimeString(),
         ),
         array(
           'name'           => 'organization-adviser',
           'theme'          => 'theme-teal',
           'color'          => 'bg-teal',
           'deleted_or_not' => '1',
           'created_at' => Carbon::now()->toDateTimeString(),
           'updated_at' => Carbon::now()->toDateTimeString(),
         ),
         array(
           'name'           => 'organization-head',
           'theme'          => 'theme-brown',
           'color'          => 'bg-brown',
           'deleted_or_not' => '1',
           'created_at' => Carbon::now()->toDateTimeString(),
           'updated_at' => Carbon::now()->toDateTimeString(),
         ),
         array(
           'name'           => 'organization-member',
           'theme'          => 'theme-blue-grey',
           'color'          => 'bg-blue-grey',
           'deleted_or_not' => '1',
           'created_at' => Carbon::now()->toDateTimeString(),
           'updated_at' => Carbon::now()->toDateTimeString(),
         ),
         array(
           'name'           => 'osa-personnel',
           'theme'          => 'theme-purple',
           'color'          => 'bg-purple',
           'deleted_or_not' => '1',
           'created_at' => Carbon::now()->toDateTimeString(),
           'updated_at' => Carbon::now()->toDateTimeString(),
         )
       ]);
   }
}
