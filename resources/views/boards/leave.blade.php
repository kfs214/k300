@extends('layouts.common')
@section('title', $board->name . 'を退出しますか')

@section('content')
  <h1>{{ $board->name }}を退出しますか</h1>
  <h4>退出すると</h4>
  <ul>
    <li>メンバー一覧から削除されます。</li>
    <li>書き込んだメッセージはそのまま残ります。</li>
    @if( $board->hidden )
      <li>非公開掲示板に再度参加するには、専用のリンクが必要です。</li>
    @endif
  </ul>
  <form method="POST">
    @csrf
    <button type="submit" name="leave" value="true">退出する</button>
    <button type="button" onClick="location.href='{{ route( 'boards.board.index', ['shown_id' => $board->shown_id]) }}'">戻る</button>
  </form>
@endsection
