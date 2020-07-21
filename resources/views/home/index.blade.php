@extends('layouts.common')
@inject('services', 'App\Services\AnimalService')
@section('title', $title)

@section('content')
@if(session('aimed.url'))
  <div class="content">
      <h2>作業中のページ</h2>
      <a href="{{ session('aimed.url') }}">{{ session('aimed.url') }}</a>
  </div>
@endif

<div class="content">
  <h2>診断結果</h2>
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

  <h3>詳細をGoogleで検索する</h3>
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

<div class="content">
  @isset( $user )
    <div><!-- 新着メッセージ一覧 --></div>
    <div>
      <h2 id="boards">参加中の掲示板一覧</h2>
      <div class="row"><a href="{{ route('boards.create') }}">掲示板を新規作成する</a></div>
      @include('components.boards_list', ['mode' => 'home'])
    </div>
  @endisset
</div>
@endsection
