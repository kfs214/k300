@extends('layouts.common')
@inject('services', 'App\Services\AnimalService')
@section('title', 'home')

@section('content')
<div class="row">

  <div class="col">
    <div class="result wrap">
      <h6>診断結果</h6>
      <p>{{$user->birthday ?? $birthday}}
      生まれの
      @isset( $user )
        <br>{{$user->uname}}さんは
      @else
        @auth
          方は
        @else
          あなたは
        @endauth
      @endisset
      </p>
      <p>{!!$services->getLink($animal->aname)!!}です。</a></p>
      <h6>詳細をGoogleで検索する</h6>
      <p>60タイプ分類：{!!$services->getLink($animal->aname)!!}<br>
        12タイプ分類：{!!$services->getLink($animal->t12aname)!!}<br>
        3タイプ分類：{!!$services->getLink($animal->t3aname)!!}<br>
        リズム：{!!$services->getLink($animal->rhythm)!!}<br>
        ホワイトエンジェル：{!!$services->getLink($animal->wangel)!!}<br>
      </p>
      @auth
      <a href="{{ route('team.index') }}">チームメンバーの動物を一覧表示する</a><br>
      @else
      <a href="/">会員登録でできること・これからできるようになること</a><br>
      <a href="{{ route('register') }}">会員登録する</a><br>
      @endauth
      <a href="{{ route('simple.form') }}">他の人の生年月日で簡易診断を行う</a>
    </div>
  </div>

</div>
@endsection
