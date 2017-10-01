<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('courses')->insert([
      array(
        'name'        => 'Not Applicable',
        'description' => 'No Description yet',
        'source'      => "",
        'created_at'  => date('Y-m-d H:i:s'),
        'updated_at'  => date('Y-m-d H:i:s')
      ),
      array(
        'name'        => 'BS Agribusiness Economics',
        'description' => 'No Description yet',
        'source'      => "",
        'created_at'  => date('Y-m-d H:i:s'),
        'updated_at'  => date('Y-m-d H:i:s')
      ),
      array(
        'name'        => 'BS Food Technology',
        'description' => 'No Description yet',
        'source'      => "",
        'updated_at'  => date('Y-m-d H:i:s'),
        'created_at'  => date('Y-m-d H:i:s'),
      ),
      array(
        'name'        => 'BS Biology',
        'description' => 'No Description yet',
        'source'      => "",
        'created_at'  => date('Y-m-d H:i:s'),
        'updated_at'  => date('Y-m-d H:i:s')
      ),
      array(
        'name'        => 'BS Applied Mathematics',
        'description' => 'No Description yet',
        'source'      => "",
        'created_at'  => date('Y-m-d H:i:s'),
        'updated_at'  => date('Y-m-d H:i:s')
      ),
      array(
        'name'        => 'BS Computer Science',
        'description' => 'No Description yet',
        'source'      => "",
        'created_at'  => date('Y-m-d H:i:s'),
        'updated_at'  => date('Y-m-d H:i:s')
      ),
      array(
        'name'        => 'BS Information System Management',
        'description' => "refers to the processing of information through computers and other intelligent devices to manage and support managerial decisions within an organization",
        'source'      => "https://en.wikipedia.org/wiki/Management_information_system",
        'created_at'  => date('Y-m-d H:i:s'),
        'updated_at'  => date('Y-m-d H:i:s')
      ),
      array(
        'name'        => 'BS Architecture',
        'description' => "is a bachelor's degree designed to satisfy the academic requirement of practicing architecture",
        'source'      => "https://en.wikipedia.org/wiki/Bachelor_of_Architecture",
        'created_at'  => date('Y-m-d H:i:s'),
        'updated_at'  => date('Y-m-d H:i:s')
      ),
      array(
        'name'        => 'BA Communication Arts',
        'description' => 'No Description yet',
        'source'      => "",
        'created_at'  => date('Y-m-d H:i:s'),
        'updated_at'  => date('Y-m-d H:i:s')
      ),
      array(
        'name'        => 'BA Anthropology',
        'description' => 'No Description yet',
        'source'      => "",
        'created_at'  => date('Y-m-d H:i:s'),
        'updated_at'  => date('Y-m-d H:i:s')
      ),
    ]);
  }
}
