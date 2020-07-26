@extends('layouts.common')
@section('title', '掲示板を新規作成する')

@section('content')
  <h1>掲示板を新規作成します</h1>
  <form method="POST">
    @csrf
    <div class="scroll-table"><table>
      <tr>
        <th class="nowrap">掲示板名</th>
        <td>
          <input name="board_name" type="text" placeholder="カウカウ・リゾートの人たち" value="{{ old('board_name', session('board_name')) }}" {{ $errors->has('board_name') ? 'autofocus' : '' }}>
          @error ('board_name')
              <br><span class="invalid-feedback">{{ $message }}<br>
              ※現在{{mb_strlen(old('board_name'))}}文字</span>
          @enderror
        </td>
      </tr>
      <tr>
        <th class="nowrap">掲示板ID</th>
        <td>
          <input name="shown_id" type="text" placeholder="cowcow214" value="{{ old('shown_id', session('shown_id')) }}" {{ $errors->has('shown_id') ? 'autofocus' : '' }}>
          @error ('shown_id')
              <br><span class="invalid-feedback">{{ $message }}<br>
              ※現在{{mb_strlen(old('shown_id'))}}文字</span>
          @enderror
        </td>
      </tr>
    </table></div>
    @php
      $checked = '';
      if( old('hidden') ){
          $checked = 'checked="checked"';
      }elseif( session('hidden') ){
          $checked = 'checked="checked"';
      }
    @endphp
    <div class="row"></div>
    <div class="row">
      <input name="hidden" type="hidden" value="0">
      <label for="hidden"><input name="hidden" id="hidden" type="checkbox" value="1" {{ $checked }}>非公開掲示板にする</label><br>
      非公開掲示板は掲示板一覧に表示されず、参加するためには専用のリンクを知っている必要があります。<br>
    </div>

    <button type="submit">内容を確認する</button>
    <button type="button" onClick="location.href='{{ url()->previous() }}'">下書きを破棄して戻る</button>
  </form>
@endsection
