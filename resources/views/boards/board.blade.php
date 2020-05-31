@extends('layouts.common')
@section('title', $board->name)

@section('content')
  <h1>{{ $board->name }}</h1>
  @if( $mode == 'joined' )
    <button onClick="location.href='{{ route('boards.board.leave') }}'">退出する</button>
  @else
    <button onClick="location.href='{{ route('boards.board.join') }}'">参加する</button>
  @endif

  <h2>最近参加したユーザー</h2>
  @isset( $members )
    <a href="{{ route('boards.board.members') }}">この掲示板に参加している全てのユーザーを表示する</a>
    @include('layouts.members_list', ['mode' => 'board_index'])
  @else
    誰もいなくなってしまったようです。
  @endisset

  <h2>投稿一覧</h2>
  @isset( $posts )
    <table>
      <tr>
        <th>投稿者</th>
        <th>内容</th>
        <th>投稿日時</th>
      </tr>
      @foreach( $posts as $post)
        <tr>
          <td>{{ $post->user->uname }}（{{ $post->user->animal->aname }}）</td>
          <td>{{ $post->content }}</td>
          <td>{{ $post->created_at }}</td>
        </tr>
      @endforeach
    </table>
    {{ $post->appends(request()->query())->links() }}
  @else
    まだ投稿がないようです
  @endisset

  <h2>新規投稿</h2>
  <form method="post">
    @csrf
    <textarea name="content">
    </textarea>
    <button type="submit">書き込む</button>
  </form>
@endsection
