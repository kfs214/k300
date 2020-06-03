@extends('layouts.common')
@section('title', '掲示板を新規作成する')

@section('content')
  <h1>掲示板を新規作成します</h1>
  <form method="POST">
    @csrf
    <table>
      <tr>
        <th>掲示板名</th>
        <td>
          <input name="board_name" type="text" placeholder="カウカウ・リゾートの人たち" value="{{ old('board_name', session('board_name')) }}">
          @error ('board_name')
              <strong>{{ $message }}</strong>
          @enderror
        </td>
      </tr>
      <tr>
        <th>掲示板ID</th>
        <td>
          <input name="shown_id" type="text" placeholder="cowcow214" value="{{ old('shown_id', session('shown_id')) }}">
          @error ('shown_id')
              <strong>{{ $message }}</strong>
          @enderror
        </td>
      </tr>
    </table>
    @php
      $checked = '';
      if( old('hidden') ){
          $checked = 'checked="checked"';
      }elseif( session('hidden') ){
          $checked = 'checked="checked"';
      }
    @endphp
    <input name="hidden" type="hidden" value="0">
    <label for="hidden"><input name="hidden" id="hidden" type="checkbox" value="1" {{ $checked }}>非公開掲示板にする</label><br>
    非公開掲示板は掲示板一覧に表示されず、参加するためには専用のリンクを知っている必要があります。<br>
    <button type="submit">内容を確認する</button>
    <button type="button" onClick="location.href='{{ url()->previous() }}'">下書きを破棄して戻る</button>
  </form>
@endsection
