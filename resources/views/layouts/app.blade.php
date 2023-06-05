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

    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}" />

    <!-- Scripts -->

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @vite(['resources/sass/app.scss'])
</head>

<body>

    <div id="app">
        @include('includes.header')

        <main class="py-4">
            @yield('content')
        </main>

        @include('includes.footer')

    </div>

    @vite(['resources/js/app.js'])

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/addbucket.js') }}"></script>

    @stack('scripts')
</body>

</html>
