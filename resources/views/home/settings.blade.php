@extends('layouts.common')
@section('title', '通知設定')

@section('content')
  <h1>通知設定</h1>
  @if( session('status') )
    {{ session('status') }}
  @endisset
  <form method="POST">
    @csrf
    <table>
      <tr>
        <th>通知</th>
        <th>随時</th>
        <th>毎朝9時</th>
        <th>毎週土曜日朝9時</th>
        <th>通知しない</th>
      </tr>
      <tr>
        <th>参加中の掲示板への新しい書き込み</th>
        <td><input type="radio" name="notify_posts" value="push" {{ $user->notify_posts == 'push' ? 'checked' : ''}}></td>
        <td><input type="radio" name="notify_posts" value="everyday" {{ $user->notify_posts == 'everyday' ? 'checked' : ''}}></td>
        <td><input type="radio" name="notify_posts" value="everyweek" {{ $user->notify_posts == 'everyweek' ? 'checked' : ''}}></td>
        <td><input type="radio" name="notify_posts" value="disabled" {{ $user->notify_posts == 'disabled' ? 'checked' : ''}}></td>
      </tr>
      <tr>
        <th>参加中の掲示板への新しいユーザーの参加</th>
        <td><input type="radio" name="notify_users" value="push" {{ $user->notify_users == 'push' ? 'checked' : ''}}></td>
        <td><input type="radio" name="notify_users" value="everyday" {{ $user->notify_users == 'everyday' ? 'checked' : ''}}></td>
        <td><input type="radio" name="notify_users" value="everyweek" {{ $user->notify_users == 'everyweek' ? 'checked' : ''}}></td>
        <td><input type="radio" name="notify_users" value="disaled" {{ $user->notify_users == 'disabled' ? 'checked' : ''}}></td>
      </tr>
    </table>
    <button type="submit">通知設定を更新する</button>
  </form>
@endsection
