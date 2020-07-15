@extends('layouts.common')
@section('title', '掲示板を新規作成する')

@section('content')
  <h1>掲示板を新規作成します</h1>
  <form method="POST">
    @csrf
    <div class="scroll-table"><table>
      <tr>
        <th>掲示板名</th>
        <td>{{ session('board_name') }}</td>
      </tr>
      <tr>
        <th>掲示板ID</th>
        <td>{{ session('shown_id') }}</td>
      </tr>
      <tr>
        <th>公開設定</th>
        <td>{{ session('hidden') ? '非' : ''}}公開掲示板にする</td>
      </tr>
    </table></div>
    @if( session('hidden') )
      非公開掲示板は掲示板一覧に表示されず、参加するためには専用のリンクを知っている必要があります。
    @endif
    <br><button type="submit" name="confirmed" value="true">掲示板を作成する</button>
    <button type="button" onClick="location.href='{{ route('boards.create') }}'">戻る</button>
  </form>
@endsection
