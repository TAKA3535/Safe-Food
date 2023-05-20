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
use App\Models\Option;

class SendEmails extends Command
{
    protected $signature = 'sendmails';
    protected $description = 'メール送信';

    public function handle()
    {
        // $foodData = Food::all();
        // $foodData = Food::where('user_id', $userId)->where('alert', '=', date('Y-m-d'))->get();
        $foodData = Food::where('alert', '=', date('Y-m-d'))->get();
        $count = $foodData->count();
        foreach ($foodData as $data) {
            $alertDate = new Carbon($data->alert);

            if (date('Y-m-d') == $alertDate->format('Y-m-d')) {
                $mail = new AlertMail();
                // Foodモデルに紐付いたUserのemailカラムからメールアドレスを取得して送信
                $email = $data->user->email;
                Mail::to($email)->send($mail);
                $this->info('Mailing has been sent!');
            }
        }

        foreach ($foodData as $data) {
            $alertDate = new Carbon($data->alert);

            if (date('Y-m-d') == $alertDate->format('Y-m-d')) {
                $options = Option::where('user_id', $data->user->id)->where('enable', true)->get();
                foreach ($options as $option) {
                    $emailAddress = $option->user->email;
                    $mail = new AlertMail();
                    Mail::to($email)->send($mail);
                }
            }
        }
    }
    //     $users = User::all();

    //     foreach ($users as $user) {
    //         $foodCount = Food::where('user_id', $user->id)->count();
    //         $mailData = [
    //             'name' => $user->name,
    //             'foodCount' => $foodCount
    //         ];
    //         $mail = new AlertMail($mailData);
    //         Mail::to($foodCount->$user->email)->send($mail);
    //         $this->info('Mailing has been sent!');
    //     }
    // }
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
