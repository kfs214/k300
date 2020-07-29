@extends('layouts.common')
@section('title', $profile . 'にメッセージを送信する')

@section('content')
  <h1>{{ $profile }}にメッセージを送信します。</h1>
  <h2>送信内容</h2>
  <p>
    {!! nl2br(e($content)) !!}
  </p>
  <form method="POST" action="{{route('letters.confirm')}}">
    @csrf
    <input type="hidden" name="content" value="{{$content}}">
    <input type="hidden" name="to_user_id" value="{{$to_user_id}}">
    <button type="submit" name="confirmed" value="true">送信する</button>
    <button type="button" onClick="location.href='{{ url()->previous() }}'">戻る</button>
  </form>
@endsection
