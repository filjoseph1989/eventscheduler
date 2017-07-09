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
          'deleted_or_not' => 1,
          'created_at'     => date('Y-m-d H:i:s'),
          'updated_at'     => date('Y-m-d H:i:s')
        ),
        array(
          'name'           => 'within organizations',
          'deleted_or_not' => 1,
          'created_at'     => date('Y-m-d H:i:s'),
          'updated_at'     => date('Y-m-d H:i:s')
        ),
        array(
          'name'           => 'among organizations',
          'deleted_or_not' => 1,
          'created_at'     => date('Y-m-d H:i:s'),
          'updated_at'     => date('Y-m-d H:i:s')
        ),
      ]);
    }
}
