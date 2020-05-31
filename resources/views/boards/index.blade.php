@extends('layouts.common')
@section('title', '公開掲示板一覧')

@section('content')
  @auth
    <a href="{{ route('boards.create') }}">新規作成</a><br>
  @endauth
  @include('components.boards_list', ['mode' => 'index'])
@endsection
