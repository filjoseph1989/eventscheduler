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
            'name'        => 'University',
            'acronym'     => 'UP',
            'description' => 'No description yet',
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ),
        array(
            'name'        => 'Temp My Organization',
            'acronym'     => 'TO',
            'description' => 'No description yet',
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s')
        ),
      ]);
    }
}
