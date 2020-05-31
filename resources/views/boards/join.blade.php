@extends('layouts.common')
@section('title', $board->name . 'に参加しますか')

@section('content')
  <h1>{{ $board->name }}に参加しますか</h1>
  <h4>参加すると</h4>
  <ul>
    <li>メンバー一覧に追加されます。</li>
    <li>メッセージの書き込みができるようになります。</li>
  </ul>
  <form method="POST">
    @csrf
    <button type="submit" name="join" value="true">参加する</button>
    <button onClick="location.href='{{ $url->previous() }}'">戻る</button>
  </form>
@endsection
