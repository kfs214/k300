@component('mail::message')
  @if($post_index)
# {{ $board->name }}に書き込みがありました
{{ $post_index }}
  @elseif($user_info)
# {{ $board->name }}に新しいユーザーが参加しました
{{ $user_info }}
  @endif

[{{ $board->name }}を表示する]({{ $board->url }})　　
[通知設定を変更する]({{ route('home.settings') }})
@endcomponent
