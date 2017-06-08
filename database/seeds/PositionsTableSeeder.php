<?php

use Illuminate\Database\Seeder;

class PositionsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('positions')->insert([
      array('name' => 'Student','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
      array('name' => 'instructor','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'))
    ]);
  }
}
