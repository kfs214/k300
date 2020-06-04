@component('mail::message')
@foreach($boards as $board => $posts)
# {{ $board }}に書き込みがありました
@foreach($posts as $post)
{{ Str::limit($post->content, 40, '...') }}

@endforeach
[{{ $board }}を表示する]({{ route('boards.board.index', ['shown_id' => $posts[0]->shown_id ])}})
*****

@endforeach
@endcomponent
