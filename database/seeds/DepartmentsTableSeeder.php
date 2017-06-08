<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('departments')->insert([
      array('name' => 'Computer Science Department','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
      array('name' => 'Information Technology Department','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'))
    ]);
  }
}
