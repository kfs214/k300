@isset( $boards[0] )
  @if( $mode == 'home' )
    <form method="POST">
      @csrf
  @endif
  <div class="scroll-table"><table>
    <tr>
      @if( $mode == 'home' )
        <th>通知ON</th>
      @endif
      <th class="nowrap">掲示板名</th>
      <th class="nowrap">最新の投稿</th>
      <th class="nowrap">更新日時</th>
    </tr>
    @foreach( $boards as $board )
      <tr>
        @if( $mode == 'home')
          <td>
            <input type="hidden" name="notify[{{ $board->id }}]" value="0">
            <input type="checkbox" name="notify[{{ $board->id }}]" value="1" {{ $board->pivot->notify ? 'checked="checked"' : '' }}>
          </td>
        @endif
        <td class="nowrap"><a href="{{ route('boards.board.index', ['shown_id' => $board->shown_id]) }}">{{ $board->name }}</a></td>
        <td>{{ Str::limit($board->latest_post->content ?? 'まだ投稿が存在しないようです。' , 40, '...') }}</td>
        <td>{{ $board->latest_post->created_at ?? '' }}</td>
      </tr>
    @endforeach
  </table></div>
  @if( $mode == 'home' )
    <button type="submit">個別通知設定を更新</button>
  @endif
  {{ $boards->links() }}
@else
  @if( $mode == 'index')
    公開掲示板がまだ存在しないようです。<br>
    <a href="{{ route('boards.create') }}">掲示板を新規作成する</a><br>
  @elseif( $mode == 'home' )
    掲示板にまだ参加していないようです。<br>
    <a href="{{ route('boards.index') }}">公開掲示板一覧を表示する</a><br>
  @endif
@endisset
