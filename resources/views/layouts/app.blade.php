<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Gestion Produits</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-black shadow-sm ">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <span style="color: white;">IT-SN</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item" >
                                <a class="nav-link"  href="{{ route('login') }}"><span style="color: white;">{{ __('Login') }} </span> </a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}"><span style="color: white;">{{ __('Register') }}</span></a>
                            </li>
                        @endif
                    @else
                        @canany(['create-role', 'edit-role', 'delete-role'])
                            <li><a class="nav-link" href="{{ route('roles.index') }}"><span style="color: white;">Manage Roles</span></a></li>
                        @endcanany
                        @canany(['create-user', 'edit-user', 'delete-user'])
                            <li><a class="nav-link" href="{{ route('users.index') }}"><span style="color: white;">Manage Users</span></a></li>
                        @endcanany
                        @canany(['create-produit', 'edit-produit', 'delete-produit'])
                            <li><a class="nav-link" href="{{ route('produit.index') }}"><span style="color: white;">Manage Products</span></a></li>
                        @endcanany
                            @canany(['create-categories',  'delete-categories'])
                                <li><a class="nav-link" href="{{ route('categorie.index') }}"><span style="color: white;">Manage Categoris</span></a></li>
                            @endcanany
                        @canany(['create-clients', 'edit-clients', 'delete-clients'])
                            <li><a class="nav-link" href="{{ route('client.index') }}"><span style="color: white;">Manage Clients</span></a></li>
                        @endcanany
                            @canany(['create-commandes', 'edit-commandes', 'delete-commandes'])
                                <li><a class="nav-link" href="{{ route('commande.index') }}"><span style="color: white;">Manage Commandes</span></a></li>
                            @endcanany
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle bg" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <span style="color: white;">{{ Auth::user()->name }}</span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
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
        <div class="container">
            <div class="row justify-content-center mt-3">
                <div class="col-md-12">

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success text-center" role="alert">
                            {{ $message }}
                        </div>
                    @endif

                    @yield('content')

                    <div class="row justify-content-center text-center mt-3">
                        <div class="col-md-12">
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>
