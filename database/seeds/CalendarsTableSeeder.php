<?php

use Carbon\Carbon;
use App\Models\Calendar;
use Illuminate\Database\Seeder;

class CalendarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $name = [
        'University Calendar',
        'My Organization Calendar',
        'My Personnal Calendar',
      ];
      
      foreach ($name as $key => $value) {
        Calendar::create(['name' => $value]);
      }
    }
}
