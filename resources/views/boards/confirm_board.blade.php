@extends('layouts.common')
@section('title', '掲示板を新規作成する')

@section('content')
  <h1>掲示板を新規作成します</h1>
  <form method="POST">
    @csrf
    <table>
      <tr>
        <th>掲示板名</th>
        <td>{{ session('board_name') }}</td>
      </tr>
      <tr>
        <th>掲示板ID</th>
        <td>{{ session('shown_id') }}</td>
      </tr>
    </table>
    @if( session('hidden') )
      非公開掲示板にする
      非公開掲示板は掲示板一覧に表示されず、参加するためには専用のリンクを知っている必要があります。
    @else
      公開掲示板にする
    @endif
    <button type="submit" name="confirmed" value="true">掲示板を作成する</button>
    <button onClick="location.href='{{ $url->previous() }}'">下書きを破棄して戻る</button>
  </form>
@endsection
