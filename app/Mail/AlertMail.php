<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
// use Illuminate\Mail\Mailables\Content;
// use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Food;


class AlertMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    public function __construct()
    {
        //
    }

    public function build()
    {
        $foodData = Food::where('alert', '=', date('Y-m-d'))->get();
        // $foodData = Food::where('user_id', $foodData->user->id)->get();
        $count = $foodData->count();
        // dd($count);
        return $this->view('alertmails',['count'=>$count]) //メール本文呼び出し
            ->subject('通知日のお知らせ'); //件名
    }

    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         from: 'tm.safefood@gmail.com',
    //         subject: 'Alert Mail',
    //     );
    // }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'alertmails',
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
