@extends('layouts.common')
@section('title', '掲示板を新規作成する')

@section('content')
  <h1>掲示板を新規作成します</h1>
  <form method="POST">
    @csrf
    <table>
      <tr>
        <th>掲示板名</th>
        <td><input name="name" type="text" placeholder="カウカウ・リゾートの人たち" value="{{ old('name', session('name')) }}"></td>
        @error ('name')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
      </tr>
      <tr>
        <th>掲示板ID</th>
        <td><input name="shown_id" type="text" placeholder="cowcow214" value="{{ old('shown_id', session('shown_id')) }}"></td>
        @error ('shown_id')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
      </tr>
    </table>
    @php
      $checked = '';
      if( isset(old('hidden')) ){
        if( old('hidden') ){
            $checked = 'checked="checked"';
        }
      }elseif( session('hidden') ){
          $checked = 'checked="checked"';
      }
    @endphp
    <input name="hidden" type="checkbox" {{ $checked }}>非公開掲示板にする　
    非公開掲示板は掲示板一覧に表示されず、参加するためには専用のリンクを知っている必要があります。
    <button type="submit">内容を確認する</button>
    <button onClick="location.href='{{ $url->previous() }}'">下書きを破棄して戻る</button>
  </form>
@endsection
