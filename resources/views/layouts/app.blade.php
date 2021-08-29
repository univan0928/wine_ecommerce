<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TOKUOKA - ワインアドバイザー</title>
    <!-- Scripts -->    
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}"/>

    <!-- Styles -->
    <link href="{{ asset('css/app.css?v='.time()) }}" rel="stylesheet">
    <link href="{{ asset('css/main.css?v='.time()) }}" rel="stylesheet">
    <link href="{{ asset('css/style.css?v='.time()) }}" rel="stylesheet">

</head>
<body>
    <div id="app">
            @yield('header')
            @yield('navbar')
        <main class="py-4">
            @yield('content')
        </main>
        @yield('footer')
    </div>

    <script src="{{ asset('js/app.js?v='.time()) }}" defer></script>
    <script src="{{ asset('js/main.js?v='.time()) }}" defer></script>
    <!-- Fonts -->
</body>
</html>
