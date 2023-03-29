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
        // $schedule->command('sendmails')->dailyAt('15:16');	
        // $schedule->command('sendmails')->everyMinute();
        $schedule->command('sendlines')->everyMinute();
        // $schedule->command('email:newuser')->everyMinute();
        // $schedule->command('writelog')->everyMinute();
        // ここで指定した日時になると、sendLineMessageメソッドが呼び出されます。
    //     $schedule->call(function () {
    //         $this->sendLineMessage();
    //     })->everyMinute();
    //     // ->dailyAt('09:00');
    // }
    // // LINEにメッセージを送信するメソッド
    // protected function sendLineMessage()
    // {
    //     $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(env('aS/bRdr0qd4OQTLDKZ+yL0LiEBpxsFiSjJGQRchdiKORpNLPNVnKRsCdlqAIr5mDyO963+hFltDrpZ98BkLqi0kY2LFGBernZwhs8+MGkMB9F1YNMwRyJR2wBotTd3QcMRbWaqY/iXec9t+cLoQDHQdB04t89/1O/w1cDnyilFU='));
    //     $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => env('54dfad0ae02e1025b4d7bc7cd2427338')]);

    //     $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('Hello, world!');

    //     $response = $bot->pushMessage('t.m.0905714', $textMessageBuilder);

    //     if (!$response->isSucceeded()) {
    //         Log::error($response->getRawBody());
    //     }
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
