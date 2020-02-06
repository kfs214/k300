@extends('layouts.common')
@inject('services', 'App\Services\AnimalService')
@section('title', 'home')

@section('content')
  <h6>診断結果</h6>
  <p>{{$user->birthday}}<br>
    生まれの{{$user->uname}}さんは
  </p>
  <p>{!!$services->getLink($animal->aname)!!}です。</a></p>
  <h6>詳細をGoogleで検索する</h6>
    <p>60タイプ分類：{!!$services->getLink($animal->aname)!!}<br>
      12タイプ分類：{!!$services->getLink($animal->t12aname)!!}<br>
      3タイプ分類：{!!$services->getLink($animal->t3aname)!!}<br>
      リズム：{!!$services->getLink($animal->rhythm)!!}<br>
      ホワイトエンジェル：{!!$services->getLink($animal->wangel)!!}<br>
    </p>
@endsection
