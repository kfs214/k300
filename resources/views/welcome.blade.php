@extends('layouts.common')
@section('title', 'ようこそ')

@section('content')


<div class="content">
    <h1>動物で、繋がる。</h1>
    <p>みんな大好き動物占いを、今度はみんなで。</p>
    <h2>チーム機能</h2>
    <p>チームのメンバーを登録し、友だち100人を動物を元に並べ替えや絞り込みができます。チームメンバーの情報はあなたにしか表示されません。</p>
    <h2>掲示板機能</h2>
    <p>公開掲示板・非公開掲示板を自由に作成し、掲示板内のまだ見ぬ誰か100人とやりとりができます。もちろん、並べ替えや絞り込みにも対応。非公開掲示板に参加でいるのは、専用のリンクを知っている人だけです。</p>
    <h2>メッセージ機能</h2>
    <p>プライベートなメッセージを他のユーザーに送りたくなったら、メッセージ機能をご利用ください。参加している掲示板で、メンバーの名前をクリックしてみてください。のびのびと、自由に、思いのままにメッセージを送れます。制限は、マナーだけ。</p>
    <h2>簡易診断機能</h2>
    <p>会員登録せずに、まずは気軽にお試しになりたいですか？簡易診断機能は会員登録せずにご利用になれます。会員登録後も、チームに追加せずに動物の診断結果を確認できます。</p>
    <h3>通知の頻度を調整したい場合</h3>
    <p>{{ config('app.name') }}はメール通知に対応しています。通知を随時受け取ることも、1週間分をまとめて受け取ることも、思いのまま。設定画面からお好みの選択肢をお選びください。</p>
    <h1>さあ、ご一緒に。</h1>
    @auth
      <a href="{{ route('home.mypage') }}">ホームへ</a>
    @endauth
    @guest
      <a href="{{ route('register', ['openexternalbrowser' => 1]) }}">会員登録する</a>
    @endguest
</div>

@endsection
