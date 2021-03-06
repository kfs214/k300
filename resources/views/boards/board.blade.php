@extends('layouts.common')
@section('title', $board->name)

@section('content')
  <h2>{{ $board->name }}</h2>
  @if( $user_type == 'joined' )
    @if( $board->hidden )
      招待用リンク：<input type="text" value="{{ $join_url }}" onfocus="this.select();"><br>
    @endif
    <button onClick="location.href='{{ route('boards.board.leave', ['shown_id' => $board->shown_id]) }}'">退出する</button>
  @elseif( $user_type != 'guest')
      <button onClick="location.href='{{ route('boards.board.join', ['shown_id' => $board->shown_id]) }}'">参加する</button>
  @endif

  <h3>最近参加したユーザー</h3>
  @if( $members_count )
    <a href="{{ route('boards.board.members', ['shown_id' => $board->shown_id]) }}">この掲示板に参加している全てのユーザーを表示する</a><br>
    @include('components.members_list', ['mode' => 'board_index'])
  @else
    誰もいなくなってしまったようです。
  @endisset

  <h3>投稿一覧</h3>
  @isset( $posts[0] )
    @if($user_type == 'joined')
      <a href="#new_post">書き込む</a>
    @endif
    <div class="scroll-table"><table>
      <tr>
        <th>投稿者</th>
        <th >内容</th>
        <th>投稿日時</th>
      </tr>
      @foreach( $posts as $post)
        <tr>
          <td>{!! $user_type == 'joined' ? $post->user->letter_link : $post->user->shown_uname !!}</td>
          <td>{!! nl2br(innerLink(e($post->content))) !!}</td>
          <td>{{ $post->created_at }}</td>
        </tr>
      @endforeach
    </table></div>
    {{ $posts->appends(request()->query())->links() }}
  @else
    まだ投稿がないようです
  @endisset
  @if( $user_type == 'joined' )
    <h2 id="new_post">新規投稿</h3>
    <form method="post" action="{{ url()->current() }}">
      @csrf
      <textarea name="content" {{ $errors->has('content') ? 'autofocus' : '' }}>{{ old('content') ?? session('content') ?? ''}}</textarea>
      <button type="submit">書き込む</button>
    </form>
    @error('content')
      <span class="invalid-feedback">
        {{$message}}<br>
        ※現在{{mb_strlen(old('content'))}}文字
      </span>
    @enderror
  @endif
@endsection
