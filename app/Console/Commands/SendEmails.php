<?php

namespace App\Console\Commands;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\AlertMail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class SendEmails extends Command
// {
//     protected $signature = 'send:emails';

//     public function handle()
//     {
//         $date = '2023-03-06'; // 送信する日付
//         $subject = 'メールの件名';
//         $to = '送信先メールアドレス';
//         $data = [
//             // メールに含めるデータ
//         ];

//         if (date('Y-m-d') == $date) {
//             Mail::send('alertmails', $data, function($message) use ($subject, $to) {
//                 $message->to($to)->subject($subject);
//             });
//         }
//     }
// }

// {
//     protected $signature = 'send:emails';

//     protected $description = 'Send example email to users.';

//     public function handle()
//     {
//         $users = User::all();

//         foreach ($users as $user) {
//             Mail::to($user->email)->send(new AlertMail());
//         }

//         $this->info('Example emails sent successfully!');
//     }
// }

{
    protected $signature = 'sendmails';
    protected $description = 'メール送信';

    public function handle()
    {
        // $user = Auth::user(); // メール送信先のユーザー情報を取得するコードを記述する
        // $mail = new AlertMail($user);
        // Mail::to('t.m.guestmail@gmail.com')->send($mail);
        // $this->info('Mailing has been sent!');

        // $users = Auth::user();
        // $mail = new AlertMail($users);
        // foreach ($users as $user) {
        //     return Mail::to($user->email)->send(new AlertMail($user));
        // }

        // $to_email = Auth::user();
        // // $to_email = Auth::email();
        // Mail::to($to_email)->send(new AlertMail());
        // return 'Send mailing' . $to_email;


        // 送信する日付
        // $subject = 'メールの件名';
        // $to = '送信先メールアドレス';
        // $data = [
        //     // メールに含めるデータ
        // ];
        // {
        //     $date = '2023-03-08'; 
        // if (date('Y-m-d') == $date) {
        if (date('Y-m-d') == date('2023-03-15')) {
            // $user = Auth::user(); // メール送信先のユーザー情報を取得するコードを記述する
            // $user = User::all();
            $mail = new AlertMail();
            Mail::to('t.m.guestmail@gmail.com')->send($mail);
            // Mail::to($user)->send(new AlertMail());
            $this->info('Mailing has been sent!');
        }
        // }
    }
// 実行コマンド：sail php artisan schedule:work

    // public function schedule()
    // {
    //     // return $this->everyTwoMinutes();	
    //     // return $this->dailyAt('13:16');	
    //     return $this->dailyAt('13:50');
    // }
}
// sail php artisan schedule:work
// これにより、指定した時間に自動でメールが送信されます。また、スケジュールが設定されている場合は、サーバーのクロンジョブを設定して定期的に php artisan schedule:run を実行するように設定する必要があります。

// class SendEmails extends Command
// {
//     protected $signature = 'test:echo';//ここで指定したコマンドを実行すると処理が走るようになる

//     protected $description = 'echoする処理です';//コマンドの説明を記載する

//     public function __construct()
//     {
//         parent::__construct();
//     }

//     public function handle()//ここに実際に行いたい処理を書く
//     {
//         echo 'schedule_test';
//     }
// }
