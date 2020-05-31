@extends('layouts.common')
@section('title', $board->name . 'に書き込む')

@section('content')
  <h1>{{ $board->name }}に書き込みます。</h1>
  <h2>投稿内容</h2>
  <p>
    {{ $content }}
  </p>
  <form method="POST">
    @csrf
    <button type="submit" name="confirmed" value="true">投稿する</button>
    <button onClick="location.href='{{ $url->previous() }}'">戻る</button>
  </form>
@endsection
