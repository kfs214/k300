@extends('layouts.common')
@section('title', $letter->from_user->profile . 'からのメッセージ')

@section('content')
  <h1>{{ $letter->from_user->profile }}からのメッセージ</h1>
  <p>{{ $letter->content }}</p>
  <h2>{{ $letter->from_user->profile }}に返信</h2>
  @include('components.letter_form')
@endsection
