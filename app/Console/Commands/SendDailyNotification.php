<?php

namespace App\Console\Commands;

use App\Mail\SendPeriodicMail;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Mail;

class SendDailyNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send notification mail everyday';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //notify_posts
        $dt = new Carbon('-1 day');
        $dt->minute = 0;
        $dt->second = 0;

        $posts = User::select('users.email', 'boards.name', 'boards.shown_id', 'posts.content')
        ->where('notify_posts', 'everyday')
        ->rightJoin('user_board', 'users.id', '=', 'user_board.user_id')
        ->where('user_board.notify', 1)
        ->rightJoin('boards', 'user_board.board_id', '=', 'boards.id')
        ->rightJoin('posts', 'boards.id', '=', 'posts.board_id')
        ->where('posts.created_at', '>', $dt)
        ->get()->groupBy('email');

/*      敗北の記録
        $new_users = User::select('email', 'boards.name', 'boards.shown_id', 'user_board.created_at' )
        ->where('notify_users', 'everyday')
        ->rightJoin('user_board', 'users.id', '=', 'user_board.user_id')
        ->rightJoin('boards', 'boards.id', '=', 'user_board.board_id')
//        ->where('user_board.created_at', '>', $dt)
        ->get()->groupBy('email');

        dd($new_users);
        */

        if(!$posts->count()){
            return 0;
        }

        foreach($posts as $email => $ones_posts){
            $boards = $ones_posts->groupBy('shown_id');
            Mail::to($email)->send(new SendPeriodicMail($boards));
        }

        return 1;
    }
}
