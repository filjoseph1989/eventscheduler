<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserTypesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
   public function run()
   {
       DB::table('user_types')->insert([
         array(
           'name'       => 'organization-head-user',
           'theme'      => 'theme-brown',
           'color'      => 'bg-brown',
           'created_at' => Carbon::now()->toDateTimeString(),
           'updated_at' => Carbon::now()->toDateTimeString(),
         ),
         array(
           'name'       => 'organization-user',
           'theme'      => 'theme-blue-grey',
           'color'      => 'bg-blue-grey',
           'created_at' => Carbon::now()->toDateTimeString(),
           'updated_at' => Carbon::now()->toDateTimeString(),
         ),
         array(
           'name'       => 'osa-personnel',
           'theme'      => 'theme-purple',
           'color'      => 'bg-purple',
           'created_at' => Carbon::now()->toDateTimeString(),
           'updated_at' => Carbon::now()->toDateTimeString(),
         ),
       ]);
   }
}
