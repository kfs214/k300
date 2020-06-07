@extends('layouts.common')
@section('title', '公開掲示板一覧')

@section('content')
  @auth
    <a href="{{ route('boards.create') }}">新規作成</a><br>
  @endauth
  <h1>公開掲示板一覧</h1>
  @include('components.boards_list', ['mode' => 'index'])
  
  <p>非公開掲示板を含む、参加済みの掲示板の一覧は<a href="{{ route('home.mypage', ['#boards']) }}">マイページ</a>に表示されます。</p>
@endsection
