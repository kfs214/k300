@inject('services', 'App\Services\AnimalService')

@if( $members_count )
  @if( $mode == 'team' )
    <a href="#form">新たにチームメンバーを追加する</a><br>
  @endif
  @unless( $mode == 'board_index' )
    <div class="content">
      <h3>以下の条件で絞り込み検索する</h3>
      @include('components.search_by')
      ※並べ替えを有効にすると、その項目を非公開に設定しているユーザーは表示されなくなります。全てのユーザーを再び表示するには、「追加した順に表示」してください。
      <br>追加した順に表示する<a href="{{ url()->current() }}?direction=asc">▲</a><a href="{{ url()->current() }}">▼</a><br>
    </div>

    <h3>メンバー一覧</h3>
  @endunless
  @if( $members[0] )
      <div class="scroll-table"><table>
        <tr>
          @if( $mode == 'board_index' )
            <th class="nowrap">お名前</th>
            <th class="nowrap">生年月日</th>
            <th class="nowrap">60タイプ</th>
            <th class="nowrap">12タイプ</th>
            <th class="nowrap">3タイプ</th>
            <th class="nowrap">リズム</th>
          @else
            @if( $mode == 'team' )
              <th class="nowrap">{!! $services->sortLinkGen('お名前', 'name') !!}</th>
            @else
              <th class="nowrap">{!! $services->sortLinkGen('お名前', 'uname') !!}</th>
            @endif
            <th class="nowrap">{!! $services->sortLinkGen('生年月日', 'birthday') !!}</th>
            <th class="nowrap">{!! $services->sortLinkGen('60タイプ', 'acode') !!}</th>
            <th class="nowrap">{!! $services->sortLinkGen('12タイプ', 't12aname') !!}</th>
            <th class="nowrap">{!! $services->sortLinkGen('3タイプ', 't3aname') !!}</th>
            <th class="nowrap">{!! $services->sortLinkGen('リズム', 'rhythm') !!}</th>
          @endif
          <th class="nowrap">ホワイトエンジェル</th>
          <th class="nowrap">ブラックデビル</th>
          @unless($mode == 'team')
            <th class="nowrap">コメント</th>
          @endunless
        </tr>
        @foreach($members as $member)
          <tr>
            @if( $mode == 'team' )
              <td class="nowrap">{{ $member->name }}</td>
              <td>{{ $member->birthday }}</td>
              <td>{!! $services->getLink($member->animal->aname) !!}</td>
              <td>{!! $services->getLink($member->animal->t12aname) !!}</td>
              <td>{!! $services->getLink($member->animal->t3aname) !!}</td>
              <td>{!! $services->getLink($member->animal->rhythm) !!}</td>
              <td>{!! $services->getLink($member->animal->wangel) !!}</td>
              <td>{!! $services->getLink($member->animal->bdebil) !!}</td>
            @else
              <td class="nowrap">{!! $user_type == 'joined' ? $member->letter_link : $member->shown_uname !!}</td>
              <td>{{ $member->shown_birthday }}</td>
              <td>{!! $services->getLink($member->aname) !!}</td>
              <td>{!! $services->getLink($member->t12aname) !!}</td>
              <td>{!! $services->getLink($member->t3aname) !!}</td>
              <td>{!! $services->getLink($member->rhythm) !!}</td>
              <td>{!! $services->getLink($member->wangel) !!}</td>
              <td>{!! $services->getLink($member->bdebil) !!}</td>
              <td class="nowrap">{{ Str::limit($member->comment, 40, '...') }}</td>
            @endif
          </tr>
        @endforeach
      </table></div>
    @else
      該当するメンバーはいないようです。<br>
    @endif
    @unless( $mode == 'board_index' )
      {{ $members->appends(request()->query())->links() }}
    @endunless
  @else
      まだメンバーがいないようです。
  @endif
