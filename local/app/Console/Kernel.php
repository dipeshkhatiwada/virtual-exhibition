<?php

namespace App\Console;

use App\Console\Commands\EnrollSendReminderEmails;
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
        EnrollSendReminderEmails::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('sitemap:generate')->timezone('Asia/Kathmandu')->dailyAt('01:00');
        $schedule->command('tender:jobupdate')->hourly();
        $schedule->command('mailsend:sendemail')->timezone('Asia/Kathmandu')->dailyAt('02:00');
        $schedule->command('update:employees')->timezone('Asia/Kathmandu')->dailyAt('05:00');
        $schedule->command('enroll:emails')->timezone('Asia/Kathmandu')->dailyAt('01:00');

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
