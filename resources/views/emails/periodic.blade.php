@component('mail::message')
@if( $boards )
# 新着投稿
@foreach( $boards as $shown_id => $posts_onthe_board )
@if($loop->iteration > 5)
ほか{{ $loop->remaining + 1 }}つの掲示板に新着投稿があります
@break
@endif
## {{ $posts_onthe_board->first()->name }}
@foreach( $posts_onthe_board as $post)
@if($loop->iteration > 3)
ほか{{ $loop->remaining + 1 }}件
@break
@endif
{{ Str::limit($post->content, 40, '...') }}  
@endforeach

[{{ $posts_onthe_board->first()->name }}を表示する]({{ route('boards.board.index', ['shown_id' => $shown_id ])}})
* * * * *
@endforeach
@endif

@if( $letters )
#新着メッセージ
@foreach( $letters as $letter )
{{ Str::limit($member->comment, 100, '(...続きを表示する)[' . route('letters.letter', ['id' => $letter->id]) . ']') }}  
{{ $letter->from_user->profile }}
* * * * *
@endforeach
  
[受信ボックスを表示する]({{ route('letters.inbox') }})  
@endif
@endcomponent
[通知設定を変更する]({{ route('home.settings') }})
