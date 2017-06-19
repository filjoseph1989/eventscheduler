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
      array('name' => 'College of Science and Mathematics','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
      array('name' => 'College of Humanities and Social Sciences','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
      array('name' => 'School of Management','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
      array('name' => 'Department of Architecture','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
    ]);
  }
}
