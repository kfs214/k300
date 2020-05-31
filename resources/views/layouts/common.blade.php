<html>
<head>
  <title>@yield('title')|動物占い—K300</title>
  <!-- <link rel="stylesheet" type="text/css" href="/css/common.css"> -->
  <link href="{{ asset('/links/dist/css/vendor/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/links/dist/css/flat-ui.min.css') }}" rel="stylesheet">

</head>

<body>
  <div class="container">
    <!-- navigation -->
    <div class="row demo-row">
      <div class="col">
        <nav class="navbar navbar-inverse navbar-embossed navbar-expand-lg" role="navigation">
            <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name') }}</a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-01"></button>
            <div class="collapse navbar-collapse" id="navbar-collapse-01">
            <ul class="nav navbar-nav mr-auto">
              @auth
                <li><a href="{{ route('home.mypage') }}">HOME</a></li>
                <li><a href="{{ route('home.settings') }}">設定</a></li>
              @else
                <li><a href="{{ route('login') }}">LOGIN</a></li>
                <li><a href="{{ route('register') }}">新規登録</a></li>
              @endauth
                <li><a href="{{ route('simple.form') }}">簡易診断</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
        </nav><!-- /navbar -->
      </div>
    </div>
    <!-- end navigation -->
    @yield('content')
  </div>
  <!-- end container -->

  <!-- script -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <!-- Bootstrap 4 requires Popper.js -->
  <script src="https://unpkg.com/popper.js@1.14.1/dist/umd/popper.min.js" crossorigin="anonymous"></script>
  <script src="http://vjs.zencdn.net/6.6.3/video.js"></script>
  <script src="{{ asset('/links/dist/js/flat-ui.min.js') }}"></script>
  <script src="{{ asset('/links/docs/assets/js/application.js') }}"></script>
  <script src="{{ asset('/links/js/script.js') }}"></script>
</body>
</html>
