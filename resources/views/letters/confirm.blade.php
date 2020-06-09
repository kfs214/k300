@extends('layouts.common')
@section('title',　$profile . 'にメッセージを送信する')

@section('content')
  <h1>{{ $profile }}にメッセージを送信します。</h1>
  <h2>送信内容</h2>
  <p>
    {{ session('content') }}
  </p>
  <form method="POST">
    @csrf
    <button type="submit" name="confirmed" value="true">投稿する</button>
    <button type="button" onClick="location.href='{{ url()->previous() }}'">戻る</button>
  </form>
@endsection
