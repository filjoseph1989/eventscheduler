<?php

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
           array('name' => 'user', 'deleted_or_not'=>1,  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
           array('name' => 'admin', 'deleted_or_not'=>1,  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
           array('name' => 'organization adviser', 'deleted_or_not'=>1,  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
           array('name' => 'organization head', 'deleted_or_not'=>1,  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
           array('name' => 'organization member', 'deleted_or_not'=>1,  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
           array('name' => 'osa personnel', 'deleted_or_not'=>1,  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
       ]);
   }
}
