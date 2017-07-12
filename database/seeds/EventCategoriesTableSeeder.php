<?php

use Illuminate\Database\Seeder;

class EventCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('event_categories')->insert([
        array(
          'name'           => 'public view',
          'created_at'     => date('Y-m-d H:i:s'),
          'updated_at'     => date('Y-m-d H:i:s')
        ),
        array(
          'name'           => 'within organizations',
          'created_at'     => date('Y-m-d H:i:s'),
          'updated_at'     => date('Y-m-d H:i:s')
        ),
        array(
          'name'           => 'among organizations',
          'created_at'     => date('Y-m-d H:i:s'),
          'updated_at'     => date('Y-m-d H:i:s')
        ),
      ]);
    }
}
