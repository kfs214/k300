@extends('layouts.common')
@section('title', ( $mode == 'sent' ? '送' : '受' ) . '信箱')
@inject('services', 'App\Services\AnimalService')

@section('content')
  <h1>{{ $mode == 'sent' ? '送' : '受' }}信箱</h1>
  @if( $letters_count )
    <h3>{{ $mode == 'sent' ? '宛先' : '送信者' }}で絞り込み検索する</h3>
    <form method="POST" action="{{ url()->current() }}">
        @csrf
        <select name="{{ $mode == 'sent' ? 'to_user_id' : 'from_user_id' }}">
          <option value="">{{ $mode == 'sent' ? '宛先' : '送信者' }}</option>
          @foreach( $letter_users as $letter_user_id => $letter_user )
            <option value="{{ $letter_user_id }}" {{ $letter_user_id == $selected_user ? 'selected' : ''}}>{{ $letter_user }}</option>
          @endforeach
        </select>
        <button type="submit" name="search_by" value="{{ $mode == 'sent' ? 'to_user_id' : 'from_user_id' }}">
            {{ $mode == 'sent' ? '宛先' : '送信者' }}で絞り込む
        </button><br>
        <button type="submit" name="search_by" value="none">
          絞り込みを解除する
        </button><br>
    </form>


    @if( $letters->first() )
    <h3>メッセージ一覧</h3>
    <div class="scroll-table"><table>
      <tr>
        <th>{{ $mode == 'sent' ? '宛先' : '送信者' }}</th>
        <th>{!! $services->sortLinkGen('内容', 'content') !!}</th>
        <th>{!! $services->sortLinkGen('送信日時', 'created_at') !!}</th>
      </tr>
      @foreach( $letters as $letter )
        <tr>
          <th>{!! $mode == 'sent' ? $letter->to_user->letter_link : $letter->from_user->letter_link !!}</th>
          <td>{!! str_limit_plus(e($letter->content), 100, '<a href="' . route('letters.letter', $letter) . '">...続きを表示する</a>') !!}</td>
          <td>{{ $letter->created_at }}</td>
        </tr>
      @endforeach
    </table></div>
    {{ $letters->appends(request()->query())->links() }}
    @else
      該当するメッセージはないようです。<br>
    @endif
  @else
    まだメッセージがないようです。
  @endif

  <h3>{{ $mode == 'sent' ? '受' : '送' }}信箱を表示する</h3>
  <a href="{{ route($mode == 'sent' ? 'letters.inbox' : 'letters.sent') }}">{{ $mode == 'sent' ? '受' : '送' }}信箱</a>
@endsection
