<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="../css/style.css">

        <title>{{ config('app.name', 'Laravel') }}</title>
    </head>
    <body>
        <div class="top">
            <span class="icon">
            <a href="{{route('welcome')}}"><img src="../image/home.jpg"></a>
            </span>
            <span class="search">
            <form class="navbar-form" method="post" name="form1">
                <input class="form-control" type="text" name="search" placeholder="Search for products..." >
                <span class="search-button">
                    <button type="submit" class="btn btn-default"><img src="../image/search.jpg"></button>
                </span>
            </form> 
            </span>
        <span class="log">
        @if (Route::has('login'))
            <nav>
                @auth
                    <!-- <a href="{{ url('/dashboard') }}">Dashboard</a> -->
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ url('/dashboard') }}">Dashboard</a>
                    @endif
                    <a href="{{route('profile.edit')}}"> {{ __('Profile') }} </a>                                                   
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Log Out') }}</a>
                    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </nav>
        @endif
        </span>
        </div>
        <div class="nav">
            <a href="#">Processor</a>
            <a href="#">Motherboard</a>
            <a href="#">Ram</a>
            <a href="#">Monitor</a>
            <a href="#">Graphics Card</a>
            <a href="#">Storage</a>
            <a href="#">Case</a>
            <a href="#">Accessories</a>
        </div>
        <span class="cart">
            <a href="#">cart</a>
        </span>
            <main>
                {{ $slot }}
            </main>
        <div class="bottom">
            <h1>bottom</h1>
        </div>
    </body>
</html>
