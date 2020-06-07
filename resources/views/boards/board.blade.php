@extends('layouts.common')
@section('title', $board->name)

@section('content')
  <h1>{{ $board->name }}</h1>
  @if( $mode == 'joined' )
    @if( $board->hidden )
      招待用リンク：<input type="text" value="{{ $join_url }}"><br>
    @endif
    <button onClick="location.href='{{ route('boards.board.leave', ['shown_id' => $board->shown_id]) }}'">退出する</button>
  @elseif( $mode != 'guest')
      <button onClick="location.href='{{ route('boards.board.join', ['shown_id' => $board->shown_id]) }}'">参加する</button>
  @endif

  <h2>最近参加したユーザー</h2>
  @if( $members_count )
    <a href="{{ route('boards.board.members', ['shown_id' => $board->shown_id]) }}">この掲示板に参加している全てのユーザーを表示する</a><br>
    @include('components.members_list', ['mode' => 'board_index'])
  @else
    誰もいなくなってしまったようです。
  @endisset

  <h2>投稿一覧</h2>
  @isset( $posts[0] )
    @if($mode == 'joined')
      <a href="#new_post">書き込む</a>
    @endif
    <table>
      <tr>
        <th>投稿者</th>
        <th>内容</th>
        <th>投稿日時</th>
      </tr>
      @foreach( $posts as $post)
        <tr>
          <td>{{ $post->user->shown_uname }}（{{ $post->user->shown_aname }}）</td>
          <td>{{ $post->content }}</td>
          <td>{{ $post->created_at }}</td>
        </tr>
      @endforeach
    </table>
    {{ $posts->appends(request()->query())->links() }}
  @else
    まだ投稿がないようです
  @endisset
  @if( $mode == 'joined' )
    <h2 id="new_post">新規投稿</h2>
    <form method="post">
      @csrf
      <textarea name="content" {{ $errors->has('content') ? 'autofocus' : '' }}>{{ old('content') ?? session('content') ?? ''}}</textarea>
      <button type="submit">書き込む</button>
    </form>
    @error('content')
      {{$message}}
    @enderror
  @endif
@endsection
