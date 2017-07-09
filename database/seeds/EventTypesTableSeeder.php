<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EventTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('event_types')->insert([
            array(
                'name'           => 'Conference',
                'deleted_or_not' => 1,
                'created_at'     => Carbon::now()->toDateTimeString(),
                'updated_at'     => Carbon::now()->toDateTimeString(),
            ),
            array(
                'name'           => 'Symposium',
                'deleted_or_not' => 1,
                'created_at'     => Carbon::now()->toDateTimeString(),
                'updated_at'     => Carbon::now()->toDateTimeString(),
            ),
            array(
                'name'           => 'Siminar',
                'deleted_or_not' => 1,
                'created_at'     => Carbon::now()->toDateTimeString(),
                'updated_at'     => Carbon::now()->toDateTimeString(),
            ),
            array(
                'name'           => 'Workshop',
                'deleted_or_not' => 1,
                'created_at'     => Carbon::now()->toDateTimeString(),
                'updated_at'     => Carbon::now()->toDateTimeString(),
            ),
        ]);
    }
}
