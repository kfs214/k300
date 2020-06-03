<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($board_name, $post_index, $user_info)
    {
        $this->board_name = $board_name;
        $this->post_index = $post_index;
        $this->user_info = $user_info;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.push')
        ->subject('this is a test mail')
        ->with([
          'board_name' => $this->board_name,
          'post_index' => $this->post_index,
          'user_info' => $this->user_info,
        ]);
    }
}
