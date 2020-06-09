@extends('layouts.common')
@section('title', $user->profile . 'にメッセージを送信する')

@section('content')
  <h1>{{ $user->profile }}にメッセージを送ります</h1>
  @include('components.letter_form')
@endsection
