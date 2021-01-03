<?php

namespace Tracker\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Tracker\TrackerServiceProvider;

class Installer extends Command
{
    protected $signature = 'tracker:install';
    protected $description = 'Install tracker dependencies';

    public function handle()
    {
        Artisan::call('vendor:publish', [
            '--provider' => TrackerServiceProvider::class,
            '--tag' => 'tracker-migrations'
        ]);

        Artisan::call('vendor:publish', [
            '--provider' => TrackerServiceProvider::class,
            '--tag' => 'tracker-config'
        ]);

        $this->info(PHP_EOL."Tracker was installed successfully");
    }
}
