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
                'name'           => 'Personal',
                'created_at'     => Carbon::now()->toDateTimeString(),
                'updated_at'     => Carbon::now()->toDateTimeString(),
            ),
            array(
                'name'           => 'Conference',
                'created_at'     => Carbon::now()->toDateTimeString(),
                'updated_at'     => Carbon::now()->toDateTimeString(),
            ),
            array(
                'name'           => 'Symposium',
                'created_at'     => Carbon::now()->toDateTimeString(),
                'updated_at'     => Carbon::now()->toDateTimeString(),
            ),
            array(
                'name'           => 'Siminar',
                'created_at'     => Carbon::now()->toDateTimeString(),
                'updated_at'     => Carbon::now()->toDateTimeString(),
            ),
            array(
                'name'           => 'Workshop',
                'created_at'     => Carbon::now()->toDateTimeString(),
                'updated_at'     => Carbon::now()->toDateTimeString(),
            ),
            array(
                'name'           => 'Sample 2',
                'created_at'     => Carbon::now()->toDateTimeString(),
                'updated_at'     => Carbon::now()->toDateTimeString(),
            ),
            array(
                'name'           => 'Sample 3',
                'created_at'     => Carbon::now()->toDateTimeString(),
                'updated_at'     => Carbon::now()->toDateTimeString(),
            ),
            array(
                'name'           => 'Sample 4',
                'created_at'     => Carbon::now()->toDateTimeString(),
                'updated_at'     => Carbon::now()->toDateTimeString(),
            ),
            array(
                'name'           => 'Sample 5',
                'created_at'     => Carbon::now()->toDateTimeString(),
                'updated_at'     => Carbon::now()->toDateTimeString(),
            ),
            array(
                'name'           => 'Sample 6',
                'created_at'     => Carbon::now()->toDateTimeString(),
                'updated_at'     => Carbon::now()->toDateTimeString(),
            ),
            array(
                'name'           => 'Sample 7',
                'created_at'     => Carbon::now()->toDateTimeString(),
                'updated_at'     => Carbon::now()->toDateTimeString(),
            ),
            array(
                'name'           => 'Sample 8',
                'created_at'     => Carbon::now()->toDateTimeString(),
                'updated_at'     => Carbon::now()->toDateTimeString(),
            ),
            array(
                'name'           => 'Sample 9',
                'created_at'     => Carbon::now()->toDateTimeString(),
                'updated_at'     => Carbon::now()->toDateTimeString(),
            ),
            array(
                'name'           => 'Sample 10',
                'created_at'     => Carbon::now()->toDateTimeString(),
                'updated_at'     => Carbon::now()->toDateTimeString(),
            ),
            array(
                'name'           => 'Sample 11',
                'created_at'     => Carbon::now()->toDateTimeString(),
                'updated_at'     => Carbon::now()->toDateTimeString(),
            ),
            array(
                'name'           => 'Sample 12',
                'created_at'     => Carbon::now()->toDateTimeString(),
                'updated_at'     => Carbon::now()->toDateTimeString(),
            ),
            array(
                'name'           => 'Sample 13',
                'created_at'     => Carbon::now()->toDateTimeString(),
                'updated_at'     => Carbon::now()->toDateTimeString(),
            ),
            array(
                'name'           => 'Sample 14',
                'created_at'     => Carbon::now()->toDateTimeString(),
                'updated_at'     => Carbon::now()->toDateTimeString(),
            ),
            array(
                'name'           => 'Sample 15',
                'created_at'     => Carbon::now()->toDateTimeString(),
                'updated_at'     => Carbon::now()->toDateTimeString(),
            ),
            array(
                'name'           => 'Sample 16',
                'created_at'     => Carbon::now()->toDateTimeString(),
                'updated_at'     => Carbon::now()->toDateTimeString(),
            ),
            array(
                'name'           => 'Sample 17',
                'created_at'     => Carbon::now()->toDateTimeString(),
                'updated_at'     => Carbon::now()->toDateTimeString(),
            ),
            array(
                'name'           => 'Sample 18',
                'created_at'     => Carbon::now()->toDateTimeString(),
                'updated_at'     => Carbon::now()->toDateTimeString(),
            ),
            array(
                'name'           => 'Sample 19',
                'created_at'     => Carbon::now()->toDateTimeString(),
                'updated_at'     => Carbon::now()->toDateTimeString(),
            ),
            array(
                'name'           => 'Sample 20',
                'created_at'     => Carbon::now()->toDateTimeString(),
                'updated_at'     => Carbon::now()->toDateTimeString(),
            ),
            array(
                'name'           => 'Sample 21',
                'created_at'     => Carbon::now()->toDateTimeString(),
                'updated_at'     => Carbon::now()->toDateTimeString(),
            ),
        ]);
    }
}
