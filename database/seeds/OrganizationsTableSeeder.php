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
        array('name' => 'Organization', 'date_started' => date('Y-m-d H:i:s'), 'date_expired' => date('Y-m-d H:i:s'), 'url' => '', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
        array('name' => 'Alpha Phi Omega', 'date_started' => date('Y-m-d H:i:s'), 'date_expired' => date('Y-m-d H:i:s'), 'url' => 'apo.org.ph', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
        array('name' => 'Omega Alpha', 'date_started' => date('Y-m-d H:i:s'), 'date_expired' => date('Y-m-d H:i:s'), 'url' => 'oa.org.ph', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
        array('name' => 'Pi Sigma', 'date_started' => date('Y-m-d H:i:s'), 'date_expired' => date('Y-m-d H:i:s'), 'url' => 'pi.org.ph', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
      ]);
    }
}
