<?php

namespace App\Http\Controllers;

use App\Board;
use App\Mail\SendNotificationMail;
use App\Post;
use App\Rules\AlphaDashHalf;
use App\Services\AnimalService;
use Config;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Mail;
use URL;

class BoardsController extends Controller
{
    public function index(){
        $boards = Board::where( 'hidden', 0 )->paginate(20);

        foreach( $boards as $board ){
            $latest_post = Post::select('content', 'created_at')
            ->where('board_id', $board->id)->latest()->first();
            $board->latest_post = $latest_post;
        }

        session( ['redirect_to' => route( 'boards.index' )] );

        return view( 'boards.index', compact('boards') );
    }


    public function join($shown_id, Request $request){
        $board = Board::where( compact('shown_id') )->first();

        /*DB::table('user_board')->insert([
          'user_id' => Auth::id(),
          'board_id' => Board::select( 'id' )->where( compact('shown_id') )->first()->id,
        ]);*/

        //通知
        $filters = [
          ['notify_users', 'push'],
          ['user_board.notify', 1],
        ];

        $to = $board->users()->where($filters)->get();

        $shown_uname = Auth::user()->shown_uname == Config::get('view.hidden') ? Config::get('view.hidden_uname') : Auth::user()->shown_uname . 'さん';

        $user_info = $shown_uname . '（' . Auth::user()->shown_aname . '）';

        Mail::to($to)->send(new SendNotificationMail($board, '', $user_info));

        //join
        $board->users()->attach( Auth::id() );

        return redirect( route('boards.board.index', compact('shown_id')) )->with( 'status', '参加しました' );
    }


    public function leave($shown_id, Request $request){
        Board::where( compact('shown_id') )->first()->users()->detach( Auth::id() );

        $redirect_to = session( 'redirect_to' ) ?? route( 'home.mypage' );

        return redirect( $redirect_to )->with( 'status', '退出しました' );
    }


    public function showBoard($shown_id, Request $request){
        $board = Board::select( 'id', 'name', 'hidden', 'shown_id' )->where( compact('shown_id') )->first();

        $join_url = '';

        if( $board->users()->where( 'user_id', Auth::id() )->count() ){
            $mode = 'joined';
            if( $board->hidden ){
                $join_url = URL::signedRoute('boards.board.join', ['shown_id' => $board->shown_id]);
            }
        }else{
            $mode = 'guest';
        }

        $params = ['aname', 't12aname', 't3aname'];

        $members = $board->users()->latest()->take(5)->get();

        $members_count = $members->count();

        $posts = $board->posts()->with('user')->paginate(20);

        return view( 'boards.board', compact('members', 'members_count', 'posts', 'board', 'mode', 'join_url') );
    }


    public function showConfirmBoard(Request $request){
        $request->session()->reflash();

        return view( 'boards.confirm_board' );
    }


    public function showConfirmJoin($shown_id, Request $request){
        $board = Board::select( 'id', 'name', 'shown_id', 'hidden')->where( compact('shown_id') )->first();

        //非公開掲示板には署名付きURLが必須
        if( $board->hidden && !$request->hasValidSignature() ){
            abort(403);
        }

        if( $board->users()->pluck('id')->contains( Auth::id() ) ){
            return redirect( route( 'boards.board.index', compact( 'shown_id' ) ) )->with( 'status', '既に参加しています。');
        }

        return view( 'boards.join', compact('board') );
    }


    public function showConfirmLeave($shown_id, Request $request){
        $board = Board::select( 'id', 'name', 'shown_id', 'hidden')->where( compact('shown_id') )->first();

        if( !$board->users()->pluck('id')->contains( Auth::id() ) ){
            return redirect( route( 'boards.board.index', compact( 'shown_id' ) ) )->with( 'status', '参加していません。');
        }

        return view( 'boards.leave', compact('board') );
    }


    public function showConfirmMessage($shown_id, Request $request){
          $board = Board::select('shown_id', 'name')->where(compact('shown_id'))->first();

          $request->session()->reflash();

          return view('boards.confirm_message', compact('board'));
    }


    public function showCreateBoardForm(){
      $redirect_to = session( 'redirect_to' ) ?? route( 'home.mypage' );

      return view( 'boards.create', compact('redirect_to') );
    }


    public function showMembers($shown_id, Request $request){
      //初期化系
      $sort = $request->sort ?? 'created_at';
      $direction = $request->direction ?? 'desc';

      //事前取得系
      $board = Board::select( 'id', 'name', 'shown_id' )->where( compact('shown_id') )->first();
      $members = $board->users();
      $members_count = $members->count();


      $animal_groups = AnimalService::animal_groups();
      $grouped_animals = $animal_groups['grouped_animals'];
      $animal_groups = $animal_groups['animal_groups'];

      $search_by = AnimalService::searchBy($animal_groups, $request);

      $filters = $search_by['filters'];
      $selected_animals = $search_by['selected_animals'];

      $members = $members->where( $filters )->join('animals', 'animals.id', '=', 'users.acode')->orderBy($sort, $direction)->paginate(20);

      $params = ['selected_animals', 'grouped_animals', 'animal_groups', 'board', 'members', 'members_count'];

      return view('boards.members', compact( $params ));
    }


    public function storeBoard(Board $board){
        $data = [
          'name' => session('board_name'),
          'shown_id' => session('shown_id'),
          'hidden' => session('hidden'),
        ];

        $shown_id = $data['shown_id'];

        $board->fill($data)->save();

        $board->where( compact('shown_id'))->first()->users()->attach( Auth::id());

        return redirect( route('boards.board.index', compact('shown_id')));
    }


    public function storeMessage($shown_id, Post $post){
        //保存
        $board = Board::where(compact('shown_id'))->first();

        $data = [
          'content' => session('content'),
          'board_id' => $board->id,
          'user_id' => Auth::id(),
        ];

        $post->fill($data)->save();

        //通知メール送信先の絞り込みと投稿内容取得、そして送信
        $filters = [
          ['notify_posts', 'push'],
          ['user_board.notify', 1],
          ['users.id', '<>', $data['user_id']],
        ];

        $to = $board->users()->where($filters)->get();

        $post_index = Str::limit($data['content'], 40, '...');

        Mail::to($to)->send(new SendNotificationMail($board, $post_index, ''));

        return redirect( route('boards.board.index', compact('shown_id')));
    }


    public function validateCreateBoard(Request $request){
      $data = $request->validate([
        'board_name' => 'required|string|max:20|unique:boards,name',
        'shown_id' => ['required', 'max:20', new AlphaDashHalf, 'unique:boards'],
        'hidden' => 'required|boolean',
      ]);

      $board_name = $data[ 'board_name' ];
      $shown_id = $data[ 'shown_id' ];
      $hidden = $data[ 'hidden' ];

      return redirect( route('boards.confirm') )->with( compact('board_name', 'shown_id', 'hidden'));
    }


    public function validateMessage($shown_id, Request $request){
        $data = $request->validate([
          'content' => 'required|max:500',
        ]);

        $content = $data['content'];

        return redirect( route( 'boards.board.confirm', compact( 'shown_id' )))->with(compact( 'content' ));
    }
}
