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
      array(
        'name'        => 'Not Applicable',
        'description' => 'No description yet',
        'created_at'  => date('Y-m-d H:i:s'),
        'updated_at'  => date('Y-m-d H:i:s')
      ),
      array( 
        'name'        => 'OSA Staff',
        'description' => 'No description yet',
        'created_at'  => date('Y-m-d H:i:s'),
        'updated_at'  => date('Y-m-d H:i:s')
      ),
      array(
        'name'        => 'Organization Head',
        'description' => 'No description yet',
        'created_at'  => date('Y-m-d H:i:s'),
        'updated_at'  => date('Y-m-d H:i:s')
      ),
      array(
        'name'        => 'Organization Adviser',
        'description' => 'No description yet',
        'created_at'  => date('Y-m-d H:i:s'),
        'updated_at'  => date('Y-m-d H:i:s')
      ),
      array(
        'name'        => 'Vice-Chairperson',
        'description' => 'No description yet',
        'created_at'  => date('Y-m-d H:i:s'),
        'updated_at'  => date('Y-m-d H:i:s')
      ),
      array(
        'name'        => 'Vice-President',
        'description' => 'No description yet',
        'created_at'  => date('Y-m-d H:i:s'),
        'updated_at'  => date('Y-m-d H:i:s')
      ),
      array(
        'name'        => 'Secretary',
        'description' => 'No description yet',
        'created_at'  => date('Y-m-d H:i:s'),
        'updated_at'  => date('Y-m-d H:i:s')
      ),
      array(
        'name'        => 'Treasurer',
        'description' => 'No description yet',
        'created_at'  => date('Y-m-d H:i:s'),
        'updated_at'  => date('Y-m-d H:i:s')
      ),
      array(
        'name'        => 'Public Relations Officer',
        'description' => 'No description yet',
        'created_at'  => date('Y-m-d H:i:s'),
        'updated_at'  => date('Y-m-d H:i:s')
      ),
      array(
        'name'        => '1st Year Representative',
        'description' => 'No description yet',
        'created_at'  => date('Y-m-d H:i:s'),
        'updated_at'  => date('Y-m-d H:i:s')
      ),
      array(
        'name'        => '2nd Year Representative',
        'description' => 'No description yet',
        'created_at'  => date('Y-m-d H:i:s'),
        'updated_at'  => date('Y-m-d H:i:s')
      ),
      array(
        'name'        => '3rd Year Representative',
        'description' => 'No description yet',
        'created_at'  => date('Y-m-d H:i:s'),
        'updated_at'  => date('Y-m-d H:i:s')
      ),
      array(
        'name'        => 'Organization Co-Adviser',
        'description' => 'No description yet',
        'created_at'  => date('Y-m-d H:i:s'),
        'updated_at'  => date('Y-m-d H:i:s')
      ),
    ]);
  }
}
