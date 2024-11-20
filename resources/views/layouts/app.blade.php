<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ticket Platform') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js', 'resources/scss/app.scss'])
    
</head>

<body>
    <div id="app">
        {{-- NavBar --}}
        <nav class="navbar navbar-expand-md navbar-light bg-dark shadow-sm" style="min-height: 80px">
            <div class="container d-flex justify-content-between">
                {{-- Brand --}}
                <a class="navbar-brand d-flex align-items-center text-white" href="{{ url('/') }}">
                    <span class="fs-2">Ticket Platform</span>
                </a>
                {{-- Brand --}}

                {{-- Hamburger --}}
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                {{-- Hamburger --}}

                {{-- Collapsed DropDown --}}
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        {{-- Guest View - Only Login --}}
                        @guest
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @else
                        {{-- Guest View - Only Login --}}

                        {{-- Logged View - Menu --}}
                            <li class="nav-item dropdown">
                                {{-- Username toogler for dropdown --}}
                                <a id="navbarDropdown" class="fs-4 nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                {{-- Username toogler for dropdown --}}

                                {{-- Menu --}}
                                <div class="dropdown-menu dropdown-menu-right bg-dark fs-4" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item text-white" href="{{ route('admin.tickets.index') }}">
                                        {{ __('Dashboard') }}
                                    </a>

                                    <a class="dropdown-item text-white" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                                {{-- Menu --}}
                            </li>
                        {{-- Logged View - Menu --}}
                        @endguest
                    </ul>
                </div>
                {{-- Collapsed DropDown --}}
            </div>
        </nav>
        {{-- NavBar --}}

        <main class="ms-height">
            @yield('content')
        </main>
    </div>
</body>

</html>
