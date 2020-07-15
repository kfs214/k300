@extends('layouts.common')
@section('title', '通知設定')

@section('content')
  <h2>通知設定</h2>
  <form method="POST">
    @csrf
    <div class="scroll-table"><table>
      <tr>
        <th>参加中の掲示板への新しい書き込み</th>
        <td><select name="notify_posts">
          <option value="push" {{ $user->notify_posts == 'push' ? 'selected' : ''}}>随時</option>
          <option value="everyday" {{ $user->notify_posts == 'everyday' ? 'selected' : ''}}>毎朝9時</option>
          <option value="everyweek" {{ $user->notify_posts == 'everyweek' ? 'selected' : ''}}>毎週土曜日朝9時</option>
          <option value="disabled" {{ $user->notify_posts == 'disabled' ? 'selected' : ''}}>通知しない</option>
        </td>
      </tr>
      <tr>
        <th>参加中の掲示板への新しいユーザー</th>
        <td><select name="notify_users">
          <option value="push" {{ $user->notify_users == 'push' ? 'selected' : ''}}>随時</option>
          <option value="disabled" {{ $user->notify_users == 'disabled' ? 'selected' : ''}}>通知しない</option>
        </td>
      </tr>
        <th>新着メッセージ</th>
        <td><select name="notify_messages">
          <option value="push" {{ $user->notify_messages == 'push' ? 'selected' : ''}}>随時</option>
          <option value="everyday" {{ $user->notify_messages == 'everyday' ? 'selected' : ''}}>毎朝9時</option>
          <option value="everyweek" {{ $user->notify_messages == 'everyweek' ? 'selected' : ''}}>毎週土曜日朝9時</option>
          <option value="disabled" {{ $user->notify_messages == 'disabled' ? 'selected' : ''}}>通知しない</option>
        </td>
      </tr>
    </table></div>

    <div class="row"></div>
    <button type="submit">通知設定を更新する</button>
  </form>
@endsection
