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
      array('name' => 'student','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'))
    ]);
  }
}
