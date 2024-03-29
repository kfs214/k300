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
            @auth
                <a href="{{ route('home.mypage') }}">
                    <li>ホーム</li>
                </a>
                <a href="{{ route('team.index') }}">
                    <li>チーム</li>
                </a>
                <a href="{{ route('letters.inbox') }}">
                    <li>受信箱</li>
                </a>
            @endauth
            <a href="{{ route('boards.index', ['openexternalbrowser' => 1]) }}">
                <li>公開掲示板</li>
            </a>
            <a href="{{ route('simple.form') }}">
                <li>簡易診断</li>
            </a>
            @auth
                <a href="{{ route('home.settings') }}">
                    <li>設定</li>
                </a>
                <a href="{{ route('logout') }}">
                    <li>ログアウト</li>
                </a>
            @else
                <a href="{{ route('login', ['openexternalbrowser' => 1]) }}">
                    <li>ログイン</li>
                </a>
                <a href="{{ route('register', ['openexternalbrowser' => 1]) }}">
                    <li>新規登録</li>
                </a>
            @endauth
        </ul>
    </div>

    <div class="container">
        @if (session('browser_recommend'))
            <script>
                alert('推奨ブラウザではありません');
            </script>
            <div class="content">
                <h2>推奨ブラウザではありません</h2>
                <p>推奨ブラウザはSafari, Google Chromeです。</p>
                <h3>推奨ブラウザで開く</h3>
                <input type="text" value="{{ session('browser_recommend') }}">
                <p>このURLをコピーして、ブラウザに貼り付けてください。</p>
            </div>
        @endif

        <div class="alert alert-info" role="alert">
            <h4 class="alert-heading">サービス終了のお知らせ</h4>
            <p>誠に勝手ながら、2022年末でのサービス終了を決定いたしました<br />
                2023年以降はページへのアクセスを含めた全てのサービス利用ができなくなります</p>
            <p>これまでのご愛用、応援まことにありがとうございました<br />
                今後とも<a href="https://github.com/kfs214/" target="_blank">kfs214</a>をどうぞよろしくお願いいたします</p>
        </div>

        @yield('content')
    </div>
    <div class="footer">
        <p>
            ご利用に際し発生した一切の責任を開発者は負いかねますが、お気付きの点がありましたらお知らせください。<a href="https://kfs214.net/articles/425#006"
                target="_blank">kfs214</a>
        </p>
    </div>

    @if (session('status'))
        <script>
            alert('{{ session('status') }}');
        </script>
    @endif
    @if ($errors->any())
        <script>
            alert('入力に誤りがあります');
        </script>
    @endif
</body>
