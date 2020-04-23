<?php

namespace App\Console;


use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\TestCommand::class,
        \App\Console\Commands\NewsCommand::class,
        \App\Console\Commands\MailCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        // $schedule->call(function () {
        //     DB::table('words')->delete();
        // })->everyFiveMinutes();

        // $schedule->command('command:newscommand')->everyMinute();
        $schedule->command('command:newscommand')->hourly();
        // $schedule->command('command:mailcommand')->everyMinute();
        $schedule->command('command:mailcommand')->hourly()->between('10:00', '19:00');


    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
