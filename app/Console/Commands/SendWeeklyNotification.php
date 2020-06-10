<?php
//not used
namespace App\Console\Commands;

use App\Mail\SendPeriodicMail;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Mail;

class SendWeeklyNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:weekly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'not used. send notification mail everyweek';

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
      //not used
/*
      //notify_posts
      $dt = new Carbon('-7 days');
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
      
      if(!$posts->count()){
          return 0;
      }

      foreach($posts as $email => $ones_posts){
          $boards = $ones_posts->groupBy('shown_id');
          Mail::to($email)->send(new SendPeriodicMail($boards));
      }

      return 1;
*/
    }
}
