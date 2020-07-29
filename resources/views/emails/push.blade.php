@component('mail::message')
@if($post_index)
# {{ $board->name }}に書き込みがありました
{{ $post_index }}
@elseif($user_info)
# {{ $board->name }}に新しいユーザーが参加しました
{{ $user_info }}
@elseif($letter)
# {{ $letter->from_user->profile }}から新しいメッセージが届きました
{{ str_limit_mail($letter->content) }}  
@endif

@if( $board )
[{{ $board->name }}を表示する]({{ $board->url }})
@else
[受信ボックスを表示する]({{ route('letters.inbox') }})
@endif
[通知設定を変更する]({{ route('home.settings') }})
@endcomponent
