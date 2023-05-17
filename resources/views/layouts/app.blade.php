<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'EatShop')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="icon" type="image/png" href="{{ asset("img/logo.png") }}" />

    <!-- Scripts -->

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @vite(['resources/sass/app.scss'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset("img/logo.png") }}" class="pe-2" height="30" alt="">
                    <span>EatShop</span>            
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('about') }}">О нас</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('catalog') }}">Каталог</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('where') }}">Где нас найти</a>
                        </li>
                    </ul>
                </div>

            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <footer class="py-3 my-4">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">О нас</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Каталог</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Где нас найти</a></li>
            </ul>
            <p class="text-center text-muted">© 2023 EatShop</p>
        </footer>
    </div>

    @vite(['resources/js/app.js'])

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/addbucket.js') }}"></script>

</body>

</html>
