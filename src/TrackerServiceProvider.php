<?php

namespace Tracker;

use Illuminate\Support\ServiceProvider;
use Tracker\Commands\Installer;
use Tracker\Support\geoJs;

class TrackerServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/tracker.php', 'tracker');

        $this->commands([
            Installer::class
        ]);

        $this->app->singleton('geo', function (){
            return $this->app->make(config('tracker.geo_class'));
        });

    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../database/2020_09_20_150118_create_trackers_table.php' => database_path('migrations/'. date('Y_m_d') . '_99999_create_trackers_table.php')
        ], 'tracker-migrations');

        $this->publishes([
            __DIR__.'/../config/tracker.php' => config_path('tracker.php')
        ], 'tracker-config');
    }

}
