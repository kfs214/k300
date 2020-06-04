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
        $dt = new Carbon('yesterday');
        $dt->hour = 9;
        $users = User::select('users.email', 'boards.name', 'boards.shown_id', 'posts.content')
        ->where('notify_posts', 'everyday')
        ->rightJoin('user_board', 'users.id', '=', 'user_board.user_id')
        ->where('user_board.notify', 1)
        ->rightJoin('boards', 'user_board.board_id', '=', 'boards.id')
        ->rightJoin('posts', 'boards.id', '=', 'posts.board_id')
        ->where('posts.created_at', '>', $dt)
        ->withCount('posts')->get();

        $emails = $users->pluck('email')->unique();
        // $emails += $new_users->pluck('email')->unique();

        foreach($emails as $email){
            $boards = $users->where('email', $email)->groupBy('name')->all();
            //$new_users;
            Mail::to($email)->send(new SendPeriodicMail($boards));
        }

        return 1;
    }
}
