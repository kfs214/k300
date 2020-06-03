<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use URL;

class SendNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($board, $post_index, $user_info)
    {
        $this->board = $board;
        $this->board->url = route('boards.board.index', ['shown_id' => $board->shown_id]);
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
          'board' => $this->board,
          'post_index' => $this->post_index,
          'user_info' => $this->user_info,
        ]);
    }
}
