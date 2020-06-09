@if( session('status') !== null )
  {{ session('status') }}<br><br>
@endif
@if( $members_count )
  @if( $mode == 'team' )
    <a href="#form">新たにチームメンバーを追加する</a><br>
  @endif
  @unless( $mode == 'board_index' )
    @include('components.search_by')
    ※並べ替えを有効にすると、その項目を非公開に設定しているユーザーは表示されなくなります。全てのユーザーを再び表示するには、「追加した順に表示」してください。
    追加した順に表示する<a href="{{ url()->current() }}?direction=asc">▲</a><a href="{{ url()->current() }}">▼</a><br>
  @endunless
  @if( $members[0] )
    <table>
      <tr>
        @if( $mode == 'board_index' )
          <th>お名前</th>
          <th>生年月日</th>
          <th>60タイプ</th>
          <th>12タイプ</th>
          <th>3タイプ</th>
          <th>リズム</th>
        @else
          @if( $mode == 'team' )
            <th>{!! $services->sortLinkGen('お名前', 'name') !!}</th>
          @else
            <th>{!! $services->sortLinkGen('お名前', 'uname') !!}</th>
          @endif
          <th>{!! $services->sortLinkGen('生年月日', 'birthday') !!}</th>
          <th>{!! $services->sortLinkGen('60タイプ', 'acode') !!}</th>
          <th>{!! $services->sortLinkGen('12タイプ', 't12aname') !!}</th>
          <th>{!! $services->sortLinkGen('3タイプ', 't3aname') !!}</th>
          <th>{!! $services->sortLinkGen('リズム', 'rhythm') !!}</th>
        @endif
        <th>ホワイトエンジェル</th>
        <th>ブラックデビル</th>
        @unless($mode == 'team')
          <th>コメント</th>
        @endunless
      </tr>
      @foreach($members as $member)
        <tr>
          @if( $mode == 'team' )
            <td>{{ $member->name }}</td>
            <td>{{ $member->birthday }}</td>
            <td>{!! $services->getLink($member->animal->aname) !!}</td>
            <td>{!! $services->getLink($member->animal->t12aname) !!}</td>
            <td>{!! $services->getLink($member->animal->t3aname) !!}</td>
            <td>{!! $services->getLink($member->animal->rhythm) !!}</td>
            <td>{!! $services->getLink($member->animal->wangel) !!}</td>
            <td>{!! $services->getLink($member->animal->bdebil) !!}</td>
          @else
            <td>{!! $user_type == 'joined' ? $member->letter_link : $member->shown_uname !!}</td>
            <td>{{ $member->shown_birthday }}</td>
            <td>{!! $services->getLink($member->aname) !!}</td>
            <td>{!! $services->getLink($member->t12aname) !!}</td>
            <td>{!! $services->getLink($member->t3aname) !!}</td>
            <td>{!! $services->getLink($member->rhythm) !!}</td>
            <td>{!! $services->getLink($member->wangel) !!}</td>
            <td>{!! $services->getLink($member->bdebil) !!}</td>
            <td>{{ Str::limit($member->comment, 40, '...') }}</td>
          @endif
        </tr>
      @endforeach
    </table>
    @else
      該当するメンバーはいないようです。<br>
    @endif
    @unless( $mode == 'board_index' )
      {{ $members->appends(request()->query())->links() }}
    @endunless
@else
    まだメンバーがいないようです。
@endif
