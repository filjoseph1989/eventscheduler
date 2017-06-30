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
      array('name' => 'Chairperson', 'deleted_or_not'=>1,  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
      array('name' => 'Vice-Chairperson', 'deleted_or_not'=>1,  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
      array('name' => 'President', 'deleted_or_not'=>1,  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
      array('name' => 'Vice-President', 'deleted_or_not'=>1,  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
      array('name' => 'Secretary', 'deleted_or_not'=>1,  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
      array('name' => 'Treasurer', 'deleted_or_not'=>1,  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
      array('name' => 'Public Relations Officer', 'deleted_or_not'=>1,  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
      array('name' => '1st Year Representattive', 'deleted_or_not'=>1,  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
      array('name' => '2nd Year Representattive', 'deleted_or_not'=>1,  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
      array('name' => '3rd Year Representattive', 'deleted_or_not'=>1,  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
      array('name' => 'Instructor', 'deleted_or_not'=>1,  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
      array('name' => 'OSA Staff', 'deleted_or_not'=>1,  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
      array('name' => 'OSA Head', 'deleted_or_not'=>1,  'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
    ]);
  }
}
