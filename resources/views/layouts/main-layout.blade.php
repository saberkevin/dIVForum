<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>dIV Forum</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-theme.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">dIV Forum</a>
                <span class="navbar-text">@yield('title')</span>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if(!Auth::check())
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
                @else
                    <span class="navbar-text" href="#">
                        {{ Auth::user()->name }}
                    </span>

                    <li>
                        <a class="nav navbar-nav" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>


                @endif
            </ul>
        </div>
    </nav>
    @yield('content')
</body>
</html>