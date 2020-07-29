@extends('layouts.common')
@section('title', $board->name . 'に書き込む')

@section('content')
  <h1>{{ $board->name }}に書き込みます。</h1>
  <h2>投稿内容</h2>
  <p>
    {!! nl2br(e($content)) !!}
  </p>
  <form method="POST">
    @csrf
    <input type="hidden" name="content" value="{{$content}}">
    <button type="submit" name="confirmed" value="true">投稿する</button>
    <button type="button" onClick="location.href='{{ route( 'boards.board.index', ['shown_id' => $board->shown_id]) }}#new_post'">戻る</button>
  </form>
@endsection
