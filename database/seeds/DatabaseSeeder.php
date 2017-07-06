<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment() === 'production') exit();

        Eloquent::unguard();

        # Truncate all tables, except migrations
        # Please replace 'liz' in 'Tables_in_liz' with Database name of yours
        // $tables = DB::select('SHOW TABLES');
        // foreach ($tables as $table) {
        //     if ($table->Tables_in_liz !== 'migrations')
        //         DB::table($table->Tables_in_liz)->truncate();
        // }

        // Find and run all seeders
        $classes = require base_path().'/vendor/composer/autoload_classmap.php';
        foreach ($classes as $class) {
          if (strpos($class, 'TableSeeder') !== false) {
            $seederClass = substr(last(explode('/', $class)), 0, -4);
            $this->call($seederClass);
          }
        }
    }
}
