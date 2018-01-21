<!DOCTYPE html>
{{-- implicit parent --}}
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
            integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
            crossorigin="anonymous"></script>
    <script src="{{asset('js/bootstrap.js')}}"></script>
    <link href="{{asset('css/noty.css')}}" rel="stylesheet">
    <script src="{{asset('js/noty.js')}}" type="text/javascript"></script>
    @if(isset($title))
        <title>{{$title}} - Artsy</title>
    @else
        <title>Artsy</title>
    @endif
</head>

<body>

<!-- begin header -->
<div class="header">
    <div class="logo"></div>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @include('inc.nav_menu_items')
            @guest
                <form method="POST" action="{{ route('login') }}" class="form-inline my-2 my-lg-0">
                    {{ csrf_field() }}
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Login
                            </a>
                            <div class="dropdown-menu dropdown-menu-right nav-drop"
                                 aria-labelledby="navbarDropdownMenuLink">
                                <div class="nav-drop" style="margin-left:20px; margin-right:20px;">
                                    <div class="form-group">
                                        <label for="username">Username: </label>
                                        <input type="text" class="form-control" name="username" id="username">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password: </label>
                                        <input type="password" name="password" class="form-control" id="password">
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"
                                                       name="remember" {{ old('remember') ? 'checked' : '' }}> Remember
                                                Me
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row justify-content-between">
                                        <button type="submit" name="btn-login" class="btn btn-block btn-primary">Login
                                        </button>
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            Forgot Your Password?
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item  active">
                            <a class="nav-link" href="{{ url('/register') }}">Register</a>
                        </li>
                    </ul>
                </form>
            @else
                <ul class="navbar-nav" style="margin-right:100px;">
                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{Auth::user()->profile->name." ". Auth::user()->profile->surname }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ url('/profile/'.Auth::user()->profile->user_id) }}">
                                My profile
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                </ul>
            @endguest


        </div>
    </nav>
</div>

@yield('content')

<!-- begin footer -->
<footer class="footer">

    <nav class="navbar navbar-expand-lg navbar-dark blue-bg ">
        <div class="navbar-nav">
            <span>©Artsy2017</span>
        </div>
    </nav>
</footer>
<!-- end footer-->

</body>
</html>
