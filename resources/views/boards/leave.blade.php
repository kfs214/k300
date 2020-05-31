@extends('layouts.common')
@section('title', $board->name . 'を退出しますか')

@section('content')
  <h1>{{ $board->name }}を退出しますか</h1>
  <h4>退出すると</h4>
  <ul>
    <li>メンバー一覧から削除されます。</li>
    <li>書き込んだメッセージはそのまま残り、投稿者は「退出したユーザー」と表示されます。</li>
  </ul>
  <form method="POST">
    @csrf
    <button type="submit" name="leave" value="true">退出する</button>
    <button onClick="location.href='{{ $url->previous() }}'">戻る</button>
  </form>
@endsection
