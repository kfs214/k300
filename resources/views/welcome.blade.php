<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>動物占い—K300</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            img{
              width: 100%;
              margin: auto;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .title p{
                font-size: 42px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">HOME</a>
                    @else
                        <a href="{{ route('login') }}">LOGIN</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">新規登録</a>
                        @endif
                    @endauth
                    <a href="{{ route('simple.form') }}">簡易診断</a>
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    K300〜ver.2 alpha〜
                    <p>動物占い</p>
                </div>

                <h4>追加予定の機能</h4>
                  <p>※予定です</p>
                <h5>ユーザー追加機能</h5>
                  <p>チームメンバーや友人の生年月日を一括登録し、並び替えや検索ができる機能。</p>
                <h5>グループ作成機能</h5>
                  <p>登録したユーザーがグループを作り、グループ内で並び替えや検索ができる機能。</p>
                <h5>チャット・イベント作成機能</h5>
                  <p>グループ内のユーザーにメッセージを送る機能。特定の診断結果のユーザーにイベント招待を送る機能。</p>
            </div>
        </div>
        <img src="/img/R202.002.png" alt="イメージ図">
    </body>
</html>
