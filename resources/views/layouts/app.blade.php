<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <script src="{{ asset('js/app.js') }}" ></script>
    <script src="{{ asset('js/jquery-3.3.1.js') }}" ></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}" ></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}" ></script>
    <script src="{{ asset('serviceworker.js') }}" ></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@laravelPWA
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Inventario') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                      <p style='margin-left: 5em'></p>
                      <ul class="navbar-nav">
                        @can ('users.show')
                        <li class="nav-item dropdown" >
                            <a id="navbarDropdownAmbientes" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><span class="caret">Usuarios</span></a>
                              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                {{-- <a class="dropdown-item" href="/hosts"><span>Todos</span></a> --}}
                                @can ('users.show') <a class="dropdown-item" href="/users"><span>Usuarios generados</span></a>@endcan
                                @can ('users.show') <a class="dropdown-item" href="/sup_users"><span>Supervisores</span></a>@endcan
                            </div>
                        </li>
                        <p style='margin-left: 5em'></p>
                        @endcan


                        <li class="nav-item dropdown" >
                            <a id="navbarDropdownAmbientes" class="nav-link " href="/show_vigs_sup" role="button" aria-haspopup="true" aria-expanded="false" v-pre><span class="caret">Vigiladores</span></a>
                        </li>
                        <p style='margin-left: 5em'></p>
                        <li class="nav-item dropdown" >
                            <a id="navbarDropdownAmbientes" class="nav-link " href="/show_vigs_sup/reports" role="button" aria-haspopup="true" aria-expanded="false" v-pre><span class="caret">Reportados</span></a>
                        </li>
                      </ul>
                      <p style='margin-left: 30em'></p>
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav pull-xs-right">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Ingresar') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registro') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Salir') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
            @yield('content')
        </main>

    </div>


@include('sweetalert::alert')
</body>

</html>
