<?php

namespace App\Mail;

use Config;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendPeriodicMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($boards, $letters, $letters_from_count)
    {
        $this->boards = $boards;
        $this->letters = $letters;
        $this->letters_from_count = $letters_from_count;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->markdown('emails.periodic')
      ->subject('今朝までの新着情報をお伝えします【' . config('app.name') . '】')
      ->with([
        'boards' => $this->boards,
        'letters' => $this->letters,
        'letters_from_count' => $this->letters_from_count,
      ]);
    }
}
