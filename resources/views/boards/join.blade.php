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
    <button type="button" onClick="location.href='{{ route( 'boards.board.index', ['shown_id' => $board->shown_id]) }}'">戻る</button>
  </form>
@endsection
