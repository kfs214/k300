@component('mail::message')
  @if($post_index)
    <h1>{{ $board_name }}に書き込みがありました</h1>
    <p>{{ $post_index }}</p>
  @elseif($user_info)
    <h1>{{ $board_name }}に新しいユーザーが参加しました</h1>
    <p>{{ $user_info }}</p>
  @endif
@endcomponent
