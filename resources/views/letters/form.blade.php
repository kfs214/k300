@extends('layouts.common')
@section('title', session('profile') . 'にメッセージを送信する')

@section('content')
  <h1>{{ session('profile') }}にメッセージを送信します。</h1>
  @include('components.letter_form')
@endsection