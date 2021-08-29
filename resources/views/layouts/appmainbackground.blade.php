<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>TOKUOKA - ワインアドバイザー</title>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:700" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}"/>

    <link href="{{ asset('css/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('css/slick-theme.css') }}" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css?v='.time()) }}" rel="stylesheet">
    <link href="{{ asset('css/main.css?v='.time()) }}" rel="stylesheet">
    <link href="{{ asset('css/style.css?v='.time()) }}" rel="stylesheet">

    <script type="text/javascript" src="{{ asset('js/jquery3.3.1.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/slick.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
    <div id="app">   
        @include('layouts.header')
        <main class ="header-layout slider-background" style="margin-bottom: -1rem;" >
            @yield('content')
        </main>    
        
        @include('layouts.footer')            
    </div>
    
    <script src="{{ asset('js/main.js?v='.time()) }}" defer></script>
</body>
</html>
