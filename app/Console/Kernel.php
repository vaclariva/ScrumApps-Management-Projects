<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Register the commands for the application.
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
    Log::info('Sprint reminder schedule running...');

    $schedule->command('sprint:remind')
        ->everyMinute()
        ->before(function () {
            Log::info('Sprint reminder started');
        })
        ->after(function () {
            Log::info('Sprint reminder finished');
        });
    }
}
