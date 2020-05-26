<html>
<head>
  <title>@yield('title')|動物占い—K300</title>
  <!-- <link rel="stylesheet" type="text/css" href="/css/common.css"> -->
  <link href="dist/css/vendor/bootstrap.min.css" rel="stylesheet">
  <link href="dist/css/flat-ui.min.css" rel="stylesheet">

</head>

<body>
  <div class="container">
    <!-- navigation -->
    <div class="row demo-row">
      <div class="col">
        <nav class="navbar navbar-inverse navbar-embossed navbar-expand-lg" role="navigation">
            <a class="navbar-brand" href="#">牛島くん動物占い</a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-01"></button>
            <div class="collapse navbar-collapse" id="navbar-collapse-01">
            <ul class="nav navbar-nav mr-auto">
              @auth
                <li><a href="{{ url('/home') }}">HOME<span class="navbar-unread">1</span></a></li>
              @else
                <li><a href="{{ route('login') }}">LOGIN<span class="navbar-unread">1</span></a></li>
                <li><a href="{{ route('register') }}">新規登録<span class="navbar-unread">2</span></a></li>
              @endauth
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">動物の種類</a>
                    <span class="dropdown-arrow"></span>
                    <ul class="dropdown-menu">
                        <li><a href="#">ぞう</a></li>
                        <li><a href="#">猿</a></li>
                        <li><a href="#">チーター</a></li>
                        <li class="divider"></li>
                        <li><a href="#">まとめはこちら</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('simple.form') }}">簡易診断</a></li>
            </ul>
            <form class="navbar-form form-inline my-2 my-lg-0" action="#" role="search">
                <div class="form-group">
                    <div class="input-group">
                        <input class="form-control" id="navbarInput-01" type="search" placeholder="Search">
                        <span class="input-group-btn">
                        <button type="submit" class="btn"><span class="fui-search"></span></button>
                        </span>
                    </div>
                </div>
            </form>
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
  <script src="dist/js/flat-ui.min.js"></script>
  <script src="docs/assets/js/application.js"></script>
  <script src="js/script.js"></script>
</body>
</html>
