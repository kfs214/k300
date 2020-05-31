@extends('layouts.common')
@section('title', $board->name . 'のメンバー一覧')

@section('content')
  <h1>{{ $board->name }}のメンバー一覧</h1>
  @include('components.members_list', ['mode' => 'board'])

@endsection
