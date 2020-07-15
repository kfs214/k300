<html>
<!-- code name: Ikkonzome/ #FCD4D5 -->
{{-- h2 font-size: 1.5em; h3 font-size: 1.17em; --}}

<head>
  <title>@yield('title')|{{ config('app.name') }}</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('/links/common.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/links/ikkonzome.css') }}">
  <link rel="icon" href="{{ asset('/links/favicon.ico') }}">
  <meta name="viewport" content="width=device-width,initial-scale=1">
</head>

<body>
  <div class="header theme flex-container">
    <a class="title" href="{{ route('welcome') }}">{{ config('app.name') }}</a>
    <ul class="flex-container">
      <li><a href="{{ route('boards.index') }}">公開掲示板</a></li>
      <li><a href="{{ route('simple.form') }}">簡易診断</a></li>
      @auth
        <li><a href="{{ route('letters.inbox') }}">受信箱</a></li>
        <li><a href="{{ route('team.index') }}">チーム</a></li>
        <li><a href="{{ route('home.mypage') }}">ホーム</a></li>
        <li><a href="{{ route('home.settings') }}">設定</a></li>
      @else
        <li><a href="{{ route('login') }}">ログイン</a></li>
        <li><a href="{{ route('register') }}">新規登録</a></li>
      @endauth
    </ul>
  </div>
  <div class="container">
    @yield('content')
  </div>
  <div class="footer">
    <div class="container">
      <p>
        ご利用に際し発生した一切の責任を開発者は負いかねますが、お気付きの点がありましたらお知らせください。<a href="https://kfs214.net/articles/425#006" target="_blank">kfs214</a>
      </p>
    </div>
  </div>
</body>
