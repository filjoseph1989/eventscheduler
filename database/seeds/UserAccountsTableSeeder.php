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
      array('name' => 'admin','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
      array('name' => 'organization adviser','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
      array('name' => 'organization head','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
      array('name' => 'organization member','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
      array('name' => 'osa personnel','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
    ]);
  }
}
