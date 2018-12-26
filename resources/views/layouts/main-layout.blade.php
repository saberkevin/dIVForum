<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>dIV Forum - @yield('title')</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <script>
        function showDateTime() {
            @php $currentTime  = \Carbon\Carbon::now() @endphp
            var date = new Date('@php echo $currentTime @endphp');
            setInterval(function() {
                date.setSeconds(date.getSeconds() + 1);
                document.getElementById('timeNow').innerHTML =  (("0" + date.getDate()).slice(-2)) + "-" + (("0" + (date.getMonth()+1)).slice(-2)) + "-" + date.getFullYear() + " " + (("0" + date.getHours()).slice(-2)) + ":" + (("0" + date.getMinutes()).slice(-2)) + ":" + (("0" + date.getSeconds()).slice(-2));
            }, 1000);
        }
    </script>
</head>
<body onload="showDateTime()">
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <br>
                <a class="navbar-brand" href="{{ route('home') }}">dIV Forum</a>
                <!-- Master Page Links -->
                @if(Auth::check())
                    @if(Auth::user()->role->where('role_id', 1)->first())
                    <div class="dropdown">
                        <button class="dropbtn navbar-text">Master
                            <i class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-content">
                            <a href="{{ route('masterUser') }}">Master User</a>
                            <a href="{{ route('master-forum') }}">Master Forum</a>
                            <a href="{{ route('master-category') }}">Master Category</a>
                        </div>
                    </div>
                    @endif
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="#" class="nav navbar-nav">My Forum</a>
                        </li>
                    </ul>
                @endif
            </div>
            <div id="timeNow" class="nav navbar-nav navbar-right">

            </div>
            <br>
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if(!Auth::check())
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
                @else
                    <li>
                        <a href="#" class="nav navbar-nav">{{ Auth::user()->name }}</a>
                    </li>

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