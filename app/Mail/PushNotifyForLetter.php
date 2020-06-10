<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PushNotifyForLetter extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($letter)
    {
        $this->letter = $letter;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->markdown('emails.push')
      ->subject($this->letter->from_user->profile . 'からメッセージが届きました【' . config('app.name') . '】')
      ->with([
        'letter' => $this->letter,
          'board' => '',
          'post_index' => '',
          'user_info' => '',
      ]);
    }
}
