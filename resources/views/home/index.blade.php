@extends('layouts.common')
@section('title', 'home')

@section('content')
  <h6>診断結果</h6>
  <p>{{$user->CCYY}}年{{$user->MM}}月{{$user->DD}}日<br>
    生まれの{{$user->name}}さんは
  </p>
  <p>{{$animal->t60->getLink()}}です。</a></p>
  <h6>詳細をGoogleで検索する</h6>
    <p>{{$animal->t60->getLink()}}<br>
      {{$animal->t12->getLink()}}<br>
      {{$animal->t3->getLink()}}<br>
    </p>
@endsection
