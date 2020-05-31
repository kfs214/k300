<?php

namespace App\Http\Controllers;

use App\Animal;
use App\User;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('verified');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $animal = Animal::find($user->acode);

        $boards = Auth::user()->boards()->select('boards.name', 'boards.id', 'boards.shown_id')->paginate(20);
        foreach( $boards as $board ){
            $latest_post = Post::select('content', 'created_at')
            ->where('board_id', $board->id)->latest()->first();
            $board->latest_post = $latest_post;
        }

        $title = 'マイページ';

        return view('home.index', compact('user', 'animal', 'boards', 'title',));
    }


    public function showSettings(){
        $user = Auth::user()->select('notify_posts', 'notify_users', 'notify_messages')->first();
        return view('home.settings', compact( 'user' ));
    }


    public function updateIndividualSettings(Request $request){
        $validated = $request->validate([
          'notify.*' => 'required|boolean',
        ]);

        foreach( $validated['notify'] as $key => $notify ){
            \DB::table( 'user_board' )->where( 'user_id', Auth::user()->id )->where( 'board_id', $key )
            ->update( compact('notify') );
        }

        return redirect(route( 'home.mypage' ))->with('status', '更新が完了しました');
    }


    public function updateGeneralSettings(Request $request){
        $notify_setting_options = 'in:"disabled", "push", "everyday", "everyweek"';
        $data = $request->validate([
          'notify_posts' => $notify_setting_options,
          'notify_users' => $notify_setting_options,
          'notify_messages' => $notify_setting_options,
        ]);

        $user = Auth::user();
        $user->fill($data)->save();

        return redirect(route( 'home.settings' ))->with('status', '更新が完了しました');
    }
}
