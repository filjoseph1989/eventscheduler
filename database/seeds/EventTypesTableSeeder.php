<?php
require 'vendor/autoload.php';

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
                'name'           => 'Local',
                'created_at'     => Carbon::now()->toDateTimeString(),
                'updated_at'     => Carbon::now()->toDateTimeString(),
            ),
            array(
                'name'           => 'Official',
                'created_at'     => Carbon::now()->toDateTimeString(),
                'updated_at'     => Carbon::now()->toDateTimeString(),
            ),
        ]);
    }
}
