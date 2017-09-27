<?php

use Illuminate\Database\Seeder;

date_default_timezone_set('Asia/Manila');

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $this->call(CoursesTableSeeder::class);
      $this->call(EventTypesTableSeeder::class);
      $this->call(SemestersTableSeeder::class);
      $this->call(OrganizationsTableSeeder::class);
      $this->call(PositionsTableSeeder::class);
      // $this->call(UsersTableSeeder::class);
      $this->call(EventsTableSeeder::class);
    }
}
