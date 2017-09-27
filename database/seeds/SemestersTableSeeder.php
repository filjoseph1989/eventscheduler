<?php
require 'vendor/autoload.php';
use Illuminate\Database\Seeder;

class SemestersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('semesters')->insert([
            array(
                'name'           => 'First',
                'date_start'     => null,
                'date_end'       => null,
                'created_at'     => Carbon::now()->toDateTimeString(),
                'updated_at'     => Carbon::now()->toDateTimeString(),
            ),
            array(
                'name'           => 'Second',
                'date_start'     => null,
                'date_end'       => null,
                'created_at'     => Carbon::now()->toDateTimeString(),
                'updated_at'     => Carbon::now()->toDateTimeString(),
            ),
        ]);
    }
}
