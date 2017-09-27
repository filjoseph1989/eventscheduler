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
          'description'  => 'No description yet',
          'date_started' => date('Y-m-d H:i:s'),
          'date_expired' => date('Y-m-d H:i:s'),
          'url'          => '',
          'created_at'   => date('Y-m-d H:i:s'),
          'updated_at'   => date('Y-m-d H:i:s')
        ),
        array(
          'name'         => 'Alpha Phi Omega',
          'description'  => 'No description yet',
          'date_started' => date('Y-m-d H:i:s'),
          'date_expired' => date('Y-m-d H:i:s'),
          'url'          => 'http://apo.org.ph',
          'created_at'   => date('Y-m-d H:i:s'),
          'updated_at'   => date('Y-m-d H:i:s')
        ),
        array(
          'name'         => 'Omega Alpha',
          'description'  => 'No description yet',
          'date_started' => date('Y-m-d H:i:s'),
          'date_expired' => date('Y-m-d H:i:s'),
          'url'          => 'http://oa.org.ph',
          'created_at'   => date('Y-m-d H:i:s'),
          'updated_at'   => date('Y-m-d H:i:s')
        ),
        array(
          'name'         => 'Pi Sigma',
          'description'  => 'No description yet',
          'date_started' => date('Y-m-d H:i:s'),
          'date_expired' => date('Y-m-d H:i:s'),
          'url'          => 'http://pi.org.ph',
          'created_at'   => date('Y-m-d H:i:s'),
          'updated_at'   => date('Y-m-d H:i:s')
        ),
      ]);
    }
}
