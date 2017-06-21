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
      array('name' => 'Chairperson','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
      array('name' => 'Vice-Chairperson','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
      array('name' => 'President','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
      array('name' => 'Vice-President','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
      array('name' => 'Secretary','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
      array('name' => 'Treasurer','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
      array('name' => 'Public Relations Officer','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
      array('name' => '1st Year Representattive','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
      array('name' => '2nd Year Representattive','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
      array('name' => '3rd Year Representattive','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
      array('name' => 'Instructor','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
      array('name' => 'OSA Staff','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
      array('name' => 'OSA Head','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
    ]);
  }
}
