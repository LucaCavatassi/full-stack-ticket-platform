<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fontawesome 6 cdn -->
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css'
    integrity='sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=='
    crossorigin='anonymous' referrerpolicy='no-referrer' />

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Usando Vite -->
  @vite(['resources/js/app.js', 'resources/scss/app.scss'])

</head>

<body>
  <div id="app">

    <header id="header" class="navbar container-fluid navbar-dark sticky-top bg-dark flex-md-nowrap p-2 shadow">
      {{-- Navbar Title --}}
      <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/">Ticket Platform</a>
      {{-- Navbar Title --}}

      {{-- Hamburger --}}
      <button class="navbar-toggler d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      {{-- Hamburger --}}

      {{-- Nav Elements --}}
        <div class="d-none d-md-inline">
          <a class="text-white fs-5 pe-3" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </div>
    </header>

    <div class="container-fluid">
      <div class="row ms-height">
        <nav id="sidebarMenu" class="col-md-3 ms-height-sbar col-lg-2 d-md-block bg-dark ps-0 navbar-dark sidebar  collapse">
          <div class="position-sticky pt-3">

            <ul class="nav flex-column">
              {{-- Index --}}
              <li class="nav-item">
                <a class="nav-link text-white {{ Route::currentRouteName() == 'admin.tickets.index' ? 'bg-secondary' : '' }}"
                  href="{{ route('admin.tickets.index') }}">
                  <i class="fa-solid fa-ticket fa-lg fa-fw"></i> All tickets
                </a>
              </li>
              {{-- Index --}}

              {{-- Create --}}
              <li class="nav-item">
                <a class="nav-link text-white {{ Route::currentRouteName() == 'admin.tickets.create' ? 'bg-secondary' : '' }}"
                  href="{{ route('admin.tickets.create') }}">
                  <i class="fa-solid fa-plus fa-lg fa-fw"></i> Create
                </a>
              </li>
              {{-- Create --}}

              <hr style="color: white">

              {{-- Logout --}}
              <li class="nav-item d-md-none">
                <a class="nav-link text-white" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              </li>
              {{-- Logout --}}
              
            </ul>

          </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 ms-height">
          <div class="pt-3"> 
            @yield('content')
          </div>
        </main>
      </div>
    </div>

  </div>
</body>

</html>
