<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Console\Commands\SendEmails;
use App\Mail\AlertMail;

class Kernel extends ConsoleKernel
{
    // protected $commands = [
    //     Commands\testSchedule::class//追記する
    // ];
    /**
     * Define the application's command schedule.
     */
    // protected function schedule(Schedule $schedule): void
    // {
    //     $schedule->command('inspire')->hourly();
    // }

    //$schedule プロパティに、定期的に実行するタスクを定義
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('sendmails')->everyMinute();	
        // $schedule->command('writelog')->everyMinute();
        // $schedule->command('email:newuser')->everyMinute();
        // $schedule->command('writelog')->everyMinute();
    }

    // protected function schedule(Schedule $schedule): void
    // {
    //     $schedule->command('test:echo')->hourly();//1の手順で$signatureに記載したものを指定する
    // }
    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
