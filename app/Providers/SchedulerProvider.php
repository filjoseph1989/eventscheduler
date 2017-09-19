<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SchedulerProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // require_once app_path() . '/Helpers/RandomHelper.php';
        $this->app->singleton(App\Helpers\RandomHelper::class, function () { 
            return new RandomHelper(); 
        });
    }
}
