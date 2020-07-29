@extends('layouts.common')
@section('title', $profile . 'にメッセージを送信する')

@section('content')
  <h1>{{ $profile }}にメッセージを送信します。</h1>
  @include('components.letter_form')
@endsection
