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
      $this->call(PositionsTableSeeder::class);
      $this->call(EventsTableSeeder::class);
      $this->call(UserTypesTableSeeder::class);
      // $this->call(UsersTableSeeder::class); 
      //no need for UsersTableSeeder because osa will create org head which is an automatic active(status) user, 
      //org head will create org member users
    }
}
