<?php

namespace App\Console\Commands;

use App\Mail\SendPeriodicMail;
use App\User;
use App\Letter;
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
    protected $signature = 'notify {freq}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send notification mail {freq= 周期を指定、everyday or everyweek}';

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
        //準備
        $freq = $this->argument("freq");
        if($freq == 'everyday'){
          $dt = new Carbon('-1 day');
        }else{
          $dt = new Carbon('-7 days');
        }
        
        $dt->minute = 0;
        $dt->second = 0;
        
        //notify_posts
        $posts = User::select('users.email', 'boards.name', 'boards.shown_id', 'posts.content', 'posts.created_at')
        ->where('notify_posts', $freq)
        ->rightJoin('user_board', 'users.id', '=', 'user_board.user_id')
        ->where('user_board.notify', 1)
        ->rightJoin('boards', 'user_board.board_id', '=', 'boards.id')
        ->rightJoin('posts', 'boards.id', '=', 'posts.board_id')
        ->where('posts.created_at', '>', $dt)
        ->get()->groupBy('email');
        
        //notify_letters
        $letters = Letter::select('users.email', 'letters.id', 'letters.content', 'letters.from_user_id')
        ->where('letters.created_at', '>', $dt)
        ->join('users', 'letters.to_user_id', 'users.id')
        ->where('notify_posts', $freq)
        ->orderBy('letters.created_at', 'desc')
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
        
        $notifications = [];
        
        foreach( $posts as $email => $ones_posts){
          $notifications[$email]['posts'] = $ones_posts;
          if($letters->keys()->contains($email)){
            $notifications[$email]['letters'] = $letters->get($email);
          }
        }
        
        foreach( $letters->diffKeys($posts) as $email => $ones_letters ){
          $notifications[$email]['letters'] = $letters->get($email);
        }

        if(!$posts->count() && !$letters->count()){
            return 0;
        }

        foreach($notifications as $email => $ones_notifications){
            $boards = collect($ones_notifications['posts'] ?? '')->groupBy('shown_id');
            
            $ones_letters = $ones_notifications['letters'] ?? collect('');
            
            $ones_letters_from_count = $ones_letters->groupBy('from_user_id')->count();
            
            Mail::to($email)->send(new SendPeriodicMail($boards, $ones_letters, $ones_letters_from_count));
        }

        return 1;
    }
}
