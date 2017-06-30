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
        array('name' => 'Alpha Phi Omega', 'status'=>1, 'deleted_or_not'=>1,  'deleted_or_not'=>1, 'date_started' => date('Y-m-d H:i:s'), 'date_expired' => date('Y-m-d H:i:s'), 'url' => 'apo.org.ph', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
        array('name' => 'Omega Alpha', 'status'=>1, 'deleted_or_not'=>1,  'date_started' => date('Y-m-d H:i:s'), 'date_expired' => date('Y-m-d H:i:s'), 'url' => 'oa.org.ph', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
        array('name' => 'Pi Sigma', 'status'=>1, 'deleted_or_not'=>1,  'date_started' => date('Y-m-d H:i:s'), 'date_expired' => date('Y-m-d H:i:s'), 'url' => 'pi.org.ph', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
      ]);
    }
}
