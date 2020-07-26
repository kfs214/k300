@extends('layouts.common')
@section('title', $letter->from_user->profile . 'からのメッセージ')

@section('content')
  @if($mode == 'sent')
    <h1>{{ $letter->to_user->profile }}へのメッセージ</h1>
  @else
    <h1>{{ $letter->from_user->profile }}からのメッセージ</h1>
  @endif
  <p>{!! nl2br(innerLink(e($letter->content))) !!}</p>
  @if($mode == 'inbox')
    <h2>{{ $letter->from_user->profile }}に返信</h2>
    @include('components.letter_form')
  @else
    <button type="button" onClick="location.href='{{ url()->previous() }}'">戻る</button>
  @endif
@endsection
