<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('front/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('front/css/style.css') }}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>
<body  class="default">
    <header class="header">
        <nav class="navbar navbar-default  navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{route('home')}}">
                        SampleApp
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right" style="padding-right: 80px;">
                        <li>
                            <a href="{{route('home')}}">
                                Home
                            </a>
                        </li>
                        <li  @if(Route::currentRouteName() == 'front.articles') class="active" @endif>
                            <a href="{{route('front.articles')}}">
                                Articles
                            </a>
                        </li>
                        <li  @if(Route::currentRouteName() == 'front.newslist') class="active" @endif>
                            <a href="{{route('front.newslist')}}">
                                News
                            </a>
                        </li>
                        <li  @if(Route::currentRouteName() == 'front.recipes') class="active" @endif>
                            <a href="{{route('front.recipes')}}">
                                Recipes
                            </a>
                        </li>


                        @if(!Auth::check())
                            <li><a href="{{route('login')}}">Login</a></li>
                            <li><a href="{{route('register')}}">Register</a></li>
                        @endif
                    </ul>
                </div>

                @if(Auth::check())
                <div class="my-account-block">
                    <ul>
                        <li class="dropdown my-account">
                            <a href="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="http://demo.lavalite.org/img/avatar/male.png" class="img-resopnsive img-circle menu-account-img" alt=""></a>
                            <ul class="dropdown-menu">
                                {{--<li><a href="http://demo.lavalite.org/profile"><i class="ion ion-android-person"></i>Profile</a></li>
                                <li><a href="http://demo.lavalite.org/password"><i class="ion ion-android-settings"></i>Settings</a></li>--}}
                                <li><a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="ion ion-android-exit"></i>Log Out</a></li>
                            </ul>
                        </li>
                    </ul>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
                @endif
            </div>
        </nav>
    </header>

        @yield('content')

    <footer class="footer">
        <div class="container-fluid">
            <div class="row footer-logo">
                <div class="col-md-12 text-center">

                </div>
            </div>
            <div class="row footer-links">
                <div class="col-sm-4 social-links">

                </div>
                <div class="col-sm-4 copyright">
                    <p>© 2016 nxb </p>
                </div>
                <div class="col-sm-4 footer-navs">
                    <a href="">Home</a>
                    <a href="">News</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
