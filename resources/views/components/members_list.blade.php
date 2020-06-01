@inject('services', 'App\Services\AnimalService')

@if( session('status') !== null )
  {{ session('status') }}<br><br>
@endif
@if( $members_count )
  @if( $mode == 'team' )
    <a href="#form">新たにチームメンバーを追加する</a><br>
  @endif
  @unless( $mode == 'board_index' )
    <div>
      <h3>以下の条件で絞り込み検索する</h3>
      <form method="POST" action="{{ url()->current() }}">
          @csrf
          <select name="t12aname">
            <option value="">12タイプ</option>
            @foreach( $animal_groups['t12anames'] as $t4aname => $t12anames )
              <optgroup label="---{{ $t4aname }}---">
              <option value="{{ $loop->iteration }}" {{ $loop->iteration == $selected_animals['t12aname'] ? 'selected' : ''}}>{{ $t4aname }}（以下の3種類すべて）</option>
                @foreach( $t12anames as $t12aname )
                  <option value="{{ $t12aname }}" {{ $t12aname == $selected_animals['t12aname'] ? 'selected' : ''}}>{{ $t12aname }}</option>
                @endforeach
              </optgroup>
            @endforeach
            <optgroup label="---3タイプ---">
            @foreach( $animal_groups['t3anames'] as $t3aname )
              <option value="{{ $t3aname }}" {{ $t3aname == $selected_animals['t12aname'] ? 'selected' : ''}}>{{ $t3aname }}</option>
            @endforeach
          </select>

          <select name="rhythm">
            <option value="">リズム</option>
            @foreach( $animal_groups['rhythms'] as $rhythm )
              <option value="{{ $rhythm }}" {{ $rhythm == $selected_animals['rhythm'] ? 'selected' : ''}}>{{ $rhythm }}</option>
            @endforeach
          </select>

          <button type="submit" name="search_by" value="groups">
              AND検索で絞り込む
          </button><br><br>

          <select name="acode">
            <option value="">60タイプ</option>
            @foreach( $grouped_animals as $t3animal => $t12animals )
              <optgroup label="---{{ $t3animal }}---"></optgroup>
              @foreach( $t12animals as $t12animal => $t60animals)
                <optgroup label="{{ $t12animal }}">
                @foreach( $t60animals as $t60animal )
                  <option value="{{ $t60animal->id }}" {{ $t60animal->id == $selected_animals['acode'] ? 'selected' : ''}}>{{ $t60animal->aname }}</option>
                @endforeach
                </optgroup>
              @endforeach
            @endforeach
          </select>

          <button type="submit" name="search_by" value="acode">
              60タイプで絞り込む
          </button><br>
          <button type="submit" name="search_by" value="none">
            絞り込みを解除する
          </button>
      </form>
    </div>
    追加した順に表示する<a href="{{ url()->current() }}?direction=asc">▲</a><a href="{{ url()->current() }}">▼</a><br>
  @endunless
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
            <td>{{ $member->shown_uname }}</td>
            <td>{{ $member->birthday }}</td>
            <td>{!! $services->getLink($member->aname) !!}</td>
            <td>{!! $services->getLink($member->t12aname) !!}</td>
            <td>{!! $services->getLink($member->t3aname) !!}</td>
            <td>{!! $services->getLink($member->rhythm) !!}</td>
            <td>{!! $services->getLink($member->wangel) !!}</td>
            <td>{!! $services->getLink($member->bdebil) !!}</td>
          @endif
        </tr>
      @endforeach
    </table>
    @unless( $members[0] )
      該当するメンバーはいないようです。<br>
    @endunless
    @unless( $mode == 'board_index' )
      {{ $members->appends(request()->query())->links() }}
    @endunless
@else
    まだメンバーがいないようです。
@endif
