<?php

use Illuminate\Database\Seeder;

class OrganizationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('organizations')->insert([
        array(
          'name'         => 'Organization',
          'acronym'     => '',
          'description'  => 'No description yet',
          'url'          => '',
          'created_at'   => date('Y-m-d H:i:s'),
          'updated_at'   => date('Y-m-d H:i:s')
        ),
        array(
          'name'        => 'Alpha Phi Omega',
          'acronym'     => 'APO',
          'description' => 'No description yet',
          'url'         => 'http://apo.org.ph',
          'created_at'  => date('Y-m-d H:i:s'),
          'updated_at'  => date('Y-m-d H:i:s')
        ),
        array(
          'name'        => 'Omega Alpha',
          'acronym'     => 'OA',
          'description' => 'No description yet',
          'url'         => 'http://oa.org.ph',
          'created_at'  => date('Y-m-d H:i:s'),
          'updated_at'  => date('Y-m-d H:i:s')
        ),
        array(
          'name'        => 'Pi Sigma',
          'acronym'     => 'PS',
          'description' => 'No description yet',
          'url'         => 'http://pi.org.ph',
          'created_at'  => date('Y-m-d H:i:s'),
          'updated_at'  => date('Y-m-d H:i:s')
        ),
      ]);
    }
}
