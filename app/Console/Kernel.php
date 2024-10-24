<?php

namespace App\Console;

use App\Support\Commands\Generators\GenerateCommand;
use App\Support\Commands\LocalizeCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        LocalizeCommand::class,
        GenerateCommand::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('delete:recently-stock')
                 ->daily()
                 ->runInBackground();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        $this->load(__DIR__.'/../Support/Commands/Generators/Commands');

//        require base_path('routes/console.php');
    }
}
