<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'My Delivery')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @vite(['resources/sass/app.scss'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    My Delivery
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
                            <a class="nav-link" href="{{ route('about') }}">О нас</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('catalog') }}">Каталог</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('where') }}">Где нас найти</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('bucket') }}">Корзина</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('bucket') }}">Ваши заказы</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        @if ($isAdmin)
                            @include('includes.header.nav.admin')
                        @else
                            @include('includes.header.nav.default')
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    @vite(['resources/js/app.js'])

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/addbucket.js') }}"></script>

</body>

</html>
