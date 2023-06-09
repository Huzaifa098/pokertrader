<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @php(endAuctions())
</head>
<body class="body-app">
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('locations.index') }}">Locaties</a>
                    </li>
                    @auth

                        @if(Auth::user()->is_admin)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('offers.index') }}">Aanbiedingen</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('my_cards') }}">Verkochte kaarten</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('cards') }}">Alle kaarten</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('offers.index') }}">Pokedollars kopen</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('my_cards') }}">Mijn kaarten</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('premium_kopen') }}">premium kopen</a>
                            </li>

                        @endif
                    @endauth
                </ul>

                <!-- Balance -->
                @auth
                    @if(!Auth::user()->is_admin ?? false)
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link text-secondary" href="{{ route('offers.index') }}"><b>
                                        Balance: {{ Auth::user()->balance ?? 0 }} ₱ </b></a>
                            </li>
                        </ul>
                    @endif
                @endauth
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                @if(Auth::user()->is_premium)
                                    <img src="https://cdn-icons-png.flaticon.com/512/6364/6364343.png" width="20">
                                @endif
                                {{ Auth::user()->username }}
                            </a>


                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('profile.index') }}">
                                    {{ __('Mijn Profiel') }}
                                </a>

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>

                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @include('flash-message')

        @yield('content')
    </main>
</div>
</body>
</html>
