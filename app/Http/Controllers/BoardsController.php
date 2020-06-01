<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Board;
use App\Post;
use URL;
use Illuminate\Support\Facades\Auth;
use App\Services\AnimalService;

class BoardsController extends Controller
{
    public function index(){
        $boards = Board::where( 'hidden', 0 )->paginate(20);

        foreach( $boards as $board ){
            $latest_post = Post::select('content', 'created_at')
            ->where('board_id', $board->id)->latest()->first();
            $board->latest_post = $latest_post;
        }

        return view( 'boards.index', compact('boards') );
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

        $members = $board->users()->latest()->take(5)->with('animal')->get();

        $members_count = $members->count();

        $posts = $board->posts()->with('user')->with('animal')->paginate(20);

        return view( 'boards.board', compact('members', 'members_count', 'posts', 'board', 'mode', 'join_url') );
    }


    public function showConfirmJoin($shown_id, Request $request){
        $board = Board::select( 'id', 'hidden')->where( compact('shown_id') )->first();

        //非公開掲示板には署名付きURLが必須
        if( $board->hidden && !$request->hasValidSignature() ){
            abort(403);
        }
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
}
