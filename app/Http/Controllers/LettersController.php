<?php

namespace App\Http\Controllers;

use App\Letter;
use App\User;
use App\Mail\PushNotifyForLetter;
use App\Services\AnimalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;
use Vinkla\Hashids\Facades\Hashids;

class LettersController extends Controller
{
    public function confirm(Request $request){
      $data = session('data');

      $content = $data['content'];
      $to_user_id = $data['to_user_id'];
      $profile = $data['profile'];

      return view('letters.confirm', compact('content', 'to_user_id', 'profile'));
    }

    public function inbox(Request $request){
        //初期化系
        $mode = 'inbox';
        $sort = $request->sort ?? 'created_at';
        $direction = $request->direction ?? 'desc';
        $filters[] = ['to_user_id', Auth::id()];
        $selected_user = '';

        //事前取得系
        $letter_users = Letter::where('to_user_id', Auth::id())->get()->pluck('from_user_profile', 'from_user_id');

        $letters_count = Letter::where('to_user_id', Auth::id())->count();

        $previous = preg_replace('/\?.*/', '', url()->previous());

        //絞り込み準備
        if( $request->url() != $previous ){
            session()->forget('filters');
        }elseif( $search_by = $request->search_by ){
          if( $search_by == 'none' ){
              session()->forget('filters');

          }else{
            $filters[] = ['from_user_id', $request->from_user_id];
            $selected_user = $request->from_user_id;
          }
        }elseif( session('filters') ){
            $filters = session('filters');
            $selected_user = session('$selected_user');
        }

        //ペジネーション対応でセッション利用
        session()->flash('selected_user', $selected_user);
        session()->flash('filters', $filters);

        $letters = Letter::where($filters)->orderBy($sort, $direction)->paginate(20);

        $params = compact('mode', 'letter_users', 'letters_count', 'letters', 'selected_user');

        return view('letters.list', $params);
    }


    public function sent(Request $request){
        //初期化系
        $mode = 'sent';
        $sort = $request->sort ?? 'created_at';
        $direction = $request->direction ?? 'desc';
        $filters[] = ['from_user_id', Auth::id()];
        $selected_user = '';

        //事前取得系
        $letter_users = Letter::where('from_user_id', Auth::id())->get()->pluck('to_user_profile', 'to_user_id');

        $letters_count = Letter::where('from_user_id', Auth::id())->count();

        $previous = preg_replace('/\?.*/', '', url()->previous());

        //絞り込み準備
        if( $request->url() != $previous ){
            session()->forget('filters');
        }elseif( $search_by = $request->search_by ){
          if( $search_by == 'none' ){
              session()->forget('filters');

          }else{
            $filters[] = ['to_user_id', $request->to_user_id];
            $selected_user = $request->to_user_id;
          }
        }elseif( session('filters') ){
            $filters = session('filters');
            $selected_user = session('$selected_user');
        }

        //ペジネーション対応でセッション利用
        session()->flash('selected_user', $selected_user);
        session()->flash('filters', $filters);

        $letters = Letter::where($filters)->orderBy($sort, $direction)->paginate(20);

        $params = compact('mode', 'letter_users', 'letters_count', 'letters', 'selected_user');

        return view('letters.list', $params);
    }


    public function showForm($to_user_id){
        $to_user = User::find(Hashids::decode($to_user_id)[0]);

        $profile = $to_user->profile;

        $comment = $to_user->comment ?? '';

        $shown_aname = $to_user->shown_aname;

        return view('letters.form', compact('shown_aname', 'comment', 'to_user_id', 'profile'));
    }


    public function showLetter(Letter $letter){
      if($letter->from_user->id == Auth::id()){
          $mode = 'sent';

          $profile = $letter->to_user->profile;

          $shown_aname = $letter->to_user->shown_aname;

          $comment = '';

          $to_user_id = Hashids::encode($letter->to_user->id);
      }else{
          $mode = 'inbox';

          $profile = $letter->from_user->profile;

          $comment = $letter->from_user->comment ?? '';

          $shown_aname = $letter->from_user->shown_aname;

          $to_user_id = Hashids::encode($letter->from_user->id);
      }


      return view('letters.letter', compact('letter', 'shown_aname', 'mode', 'comment', 'to_user_id', 'profile'));
    }


    public function storeLetter(Letter $letter, Request $request){
        $data = [
          'content' => $request->content,
          'to_user_id' => Hashids::decode($request->to_user_id)[0],
          'from_user_id' => Auth::id(),
        ];

        $letter->fill($data)->save();

        if($letter->to_user->notify_messages == 'push'){
          Mail::to($letter->to_user->email)->send(new PushNotifyForLetter($letter));
        }

        return redirect(route('letters.sent'))->with('status', '送信しました。');
    }

    public function validateLetter(Request $request, $to_user_id){
        $data = $request->validate([
          'content' => 'required|max:500',
          'profile' => 'nullable'
        ]);

        $data += compact('to_user_id');

        return redirect( route('letters.confirm') )->with( compact('data') );
    }
}
