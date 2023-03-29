<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use Illuminate\Support\Facades\Log;
use App\Models\Food;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Option;


class SendLine extends Command
{
    protected $signature = 'sendlines';
    protected $description = 'Send message to user.';

    public function handle()
    {
        $foodData = Food::all();
        foreach ($foodData as $data) {
            $alertDate = new Carbon($data->alert);

            if (date('Y-m-d') == $alertDate->format('Y-m-d')) {

                Log::info('Start sending message to user.');

                $accessToken = env('LINE_ACCESS_TOKEN');
                $channelSecret = env('LINE_CHANNEL_SECRET');
                // $lineUserId = 'U91f9032d0beeafa3d217f59adc551738'; // 送信先のLINEユーザーIDを設定する
                // $lineUserId = $data->user->line_user_id;
                // ->where('enable', true)は、enableがtrueであるOptionsのみを多分取得
                // $lineUserId = $data->user->options->where('enable', true)->pluck('line_user_id')->first();
                $lineUserId = '';
                $options = Option::where('user_id', $data->user->id)->where('enable', true)->get();
                foreach ($options as $option) {
                    $lineUserId = $option->line_user_id;

                    // アクセストークンまたはチャンネルシークレットが設定されていない場合はエラーを出力する
                    if (empty($accessToken) || empty($channelSecret)) {
                        $this->error('LINE Access Token or Channel Secret is not set.');
                        return;
                    }

                    $httpClient = new CurlHTTPClient($accessToken);
                    $bot = new LINEBot($httpClient, ['channelSecret' => $channelSecret]);

                    // LINEのユーザーIDが存在しない場合はエラーを出力する
                    if (empty($lineUserId)) {
                        $this->error('LINE User ID is not set.');
                        return;
                    }

                    $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('テスト送信');

                    $response = $bot->pushMessage($lineUserId, $textMessageBuilder);
                    if ($response->isSucceeded()) {
                        $this->info('Message has been sent!');
                        Log::info('Message has been sent!');
                    } else {
                        $this->error('Failed to send message.');
                        Log::error($response->getRawBody());
                    }
                    Log::info('Finish sending message to user.');
                }
            }
        }
    }
}

//     public function handle()
//     {
//         $httpClient = new CurlHTTPClient(env('LINE_ACCESS_TOKEN'));
//         $bot = new LINEBot($httpClient, ['channelSecret' => env('LINE_CHANNEL_SECRET')]);

//         $lineUserId = 't.m.0905714';
//         $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('テスト送信');

//         $response = $bot->pushMessage($lineUserId, $textMessageBuilder);
//         $this->info('Mailing has been sent!');
//         if (!$response->isSucceeded()) {
//             Log::error($response->getRawBody());
//         }
//     }
// }
