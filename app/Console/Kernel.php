<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
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


        $schedule->command('hello:world')->timezone('Asia/Dhaka')->daily() ->at('00:10');
        $schedule->command('morning:command')->timezone('Asia/Dhaka')->daily() ->at('12:00');
        $schedule->command('evening:command')->timezone('Asia/Dhaka')->daily() ->at('23:55');
        $schedule->command('match:command')->timezone('Asia/Dhaka')->daily() ->at('23:58');
//        $schedule->command('hello:world')->timezone('Asia/Dhaka')->daily() ->at('17:26');

        $schedule->command('weekly:command')->timezone('Asia/Dhaka')->weekly()->fridays()->at('23:58');
        $schedule->command('monthly:command')->timezone('Asia/Dhaka')->monthlyOn(1, '23:58');


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
