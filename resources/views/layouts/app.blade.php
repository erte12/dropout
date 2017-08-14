<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title and description -->
    <title>@yield('title', config('constants.title'))</title>
    <meta name="description" content="@yield('description', 'Przyjazny katalog SEO oparty na autorskim skrypcie.')">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link rel="icon" href="favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        DropOut
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>
                    <form action="{{ route('search') }}" method="GET" class="navbar-form navbar-left">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Fraza wyszukiwania" name="q">
                        </div>
                        <button type="submit" class="btn btn-default">Szukaj</button>
                    </form>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->

                        <li><a href="{{ url('/') }}">Strona główna</a></li>
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Zaloguj się</a></li>
                            <li><a href="{{ route('register') }}">Zarejestruj się</a></li>
                        @else
                        <li><a href="{{ url('website/create') }}">Dodaj stronę</a></li>
                        <li><a href="{{ url('panel') }}">Panel użytkownika</a></li>
                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                Wyloguj ({{ Auth::user()->name }})
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <div id="main-page">
            @yield('content')
        </div>


    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Live reload -->
    <script src="http://localhost:35729/livereload.js"></script>

    <!-- Custom scripts -->
    @yield('footer')
</body>
</html>
