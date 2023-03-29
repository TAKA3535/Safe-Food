<?php

namespace App\Console\Commands;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\AlertMail;
use App\Models\User;
use App\Models\Food;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class SendEmails extends Command
{
    protected $signature = 'sendmails';
    protected $description = 'メール送信';

    public function handle()
    {
        $foodData = Food::all();
        foreach ($foodData as $data) {
            $alertDate = new Carbon($data->alert);

            if (date('Y-m-d') == $alertDate->format('Y-m-d')) {
                $mail = new AlertMail();
                // Mail::to('t.m.guestmail@gmail.com')->send($mail);

                // $emails = User::pluck('email');
                // foreach ($emails as $email) {
                //     Mail::to($email)->send($mail);
                // }
                // Foodモデルに紐付いたUserのemailカラムからメールアドレスを取得して送信
                $email = $data->user->email;
                Mail::to($email)->send($mail);
                $this->info('Mailing has been sent!');
            }
        }
    }
}
    // 実行コマンド：sail php artisan schedule:work

    // public function schedule()
    // {
    //     // return $this->everyTwoMinutes();	
    //     // return $this->dailyAt('13:16');	
    //     return $this->dailyAt('13:50');
    // }

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
