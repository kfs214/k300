@component('mail::message')
@if( $boards->first()->first() )
# 新着投稿
{{ $boards->count() }}件の掲示板に新着投稿があります　　
　　
* * * * *
@foreach( $boards as $shown_id => $posts_onthe_board )
@if($loop->iteration > 5)
ほか{{ $loop->remaining + 1 }}件の掲示板に新着投稿があります
@break
@endif
## {{ $posts_onthe_board->first()->name }}
@foreach( $posts_onthe_board as $post)
@if($loop->iteration > 3)
ほか{{ $loop->remaining + 1 }}件
@break
@endif
{{ str_limit_mail($post->content, 40, '...') }}
@endforeach
[{{ $posts_onthe_board->first()->name }}を表示する]({{ route('boards.board.index', ['shown_id' => $shown_id ])}})

* * * * *
@endforeach
* * * * *
　　
@endif
@if( $letters->first() )
# 新着メッセージ
{{$letters_from_count}}人からの新着メッセージが届いています

* * * * *
@foreach( $letters as $letter )
@if($loop->iteration > 5)
ほか{{ $loop->remaining + 1 }}件の新着メッセージがあります
@break
@endif
{{ str_limit_mail($letter->content, 100, ' [...続きを表示する](' . route('letters.letter', $letter) . ')') }}  
[{{ $letter->from_user->profile }}]({!! $letter->from_user->letter_url !!})から
　　
* * * * *
@endforeach
[受信ボックスを表示する]({{ route('letters.inbox') }})

* * * * *
* * * * *

@endif
[通知設定を変更する]({{ route('home.settings') }})
@endcomponent
