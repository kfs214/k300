@extends('layouts.common')
@section('title', ( $mode == 'sent' ? '送' : '受' ) . '信したメッセージ一覧')

@section('content')
  <h1>{{ $mode == 'sent' ? '送' : '受' }}信したメッセージ一覧</h1>
  @if( $letters_count )
    <form method="POST" action="{{ url()->current() }}">
        @csrf
        <select name="{{ $mode == 'sent' ? 'to_user_id' : 'from_user_id' }}">
          <option value="">{{ $mode == 'sent' ? '宛先' : '送信者' }}</option>
          @foreach( $letter_users => $letter_user )
            <option value="{{ $letter_user->to_user_id ?? $letter_user->from_user_id }}" {{ ($letter_user->to_user_id ?? $letter_user->from_user_id) == $selected_user ? 'selected' : ''}}>{{ $letter_user->profile ?? $letter_user->profile }}</option>
          @endforeach
        </select>
        <button type="submit" name="search_by" value="{{ $mode == 'sent' ? 'to_user_id' : 'from_user_id' }}">
            {{ $mode == 'sent' ? '宛先' : '送信者' }}で絞り込む
        </button><br><br>
    </form>
    @include('components.search_by')
    
    ※{{ $mode == 'sent' ? '宛先' : '送信者' }}での並べ替えを有効にすると、匿名設定のユーザーは表示されなくなります。全てのユーザーを再び表示するには、その他の項目で並べ替えしてください。
    @if( $letters[0] )
    <table>
      <tr>
        <th>{!! $services->sortLinkGen(($mode == 'sent' ? '宛先' : '送信者'), 'uname') !!}</th>
        <th>{!! $services->sortLinkGen('内容', 'content') !!}</th>
        <th>{!! $services->sortLinkGen('送信日時', 'created_at') !!}</th>
      </tr>
      @foreach( $letters as $letter )
        <tr>
          <th>{{ $letter->from_user->letter_link }}</th>
          <td>{{ Str::limit($letter_content, 100, '...続きを表示する<a href="' . route('letters.letter', ['id' => $letter->id]) . '"') }}</td>
          <td>{{ $letter->created_at }}</td>
        </tr>
      @endforeach
    </table>
    {{ $members->appends(request()->query())->links() }}
    @else
      該当するメッセージはないようです。<br>
    @endif
  @else
    まだメッセージがないようです。
  @endif
@endsection
