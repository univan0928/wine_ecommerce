<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TOKUOKA - ワインアドバイザー</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:700" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}"/>

    @yield('additional_css')

    <!-- Styles -->
    <link href="{{ asset('css/app.css?v='.time()) }}" rel="stylesheet">
    <link href="{{ asset('css/main.css?v='.time()) }}" rel="stylesheet">
    <link href="{{ asset('css/defaultstyle.css?v='.time()) }}" rel="stylesheet">
    <link href="{{ asset('css/default/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('css/default/slick-theme.css') }}" rel="stylesheet">
{{--    <script type="text/javascript" src="{{ asset('js/jquery3.3.1.js') }}"></script>--}}

    <script src="{{ asset('js/app.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/default/slick.js') }}"></script>

    <style type="text/css">
        body {
            background: #fff;

        }

        .slick-prev:before,.slick-next:before{
            content: none;
        }

        .slick-prev {
            /*background: #ad005c;*/
            /*border-radius:50%;*/
            /*padding:3px;*/



            border-top: 20px solid transparent;
            border-bottom: 20px solid transparent;
            border-right: 20px solid  #ad005c;
        }
        .slick-next {
            /*background: #ad005c;*/
            /*border-radius:50%;*/
            /*padding:3px;*/
            border-top: 20px solid transparent;
            border-bottom: 20px solid transparent;
            border-left: 20px solid  #ad005c;
        }
        .slider {
            width: 50%;
            margin: 100px auto;
        }

        .slick-slide {
            margin: 0px 20px;
        }

        .slick-slide img {
            width: 100%;
        }

        .slick-prev:before,
        .slick-next:before {
            color: black;
        }



    </style>
</head>
<body>
<div id="app">
    @include('layouts.header')
    @include('layouts.navbar')
    <main>
        @yield('content')
    </main>
    @include('layouts.footer')

    @yield('additional_script')


    <script src="{{ asset('js/main.js?v='.time()) }}" defer></script>
</div>
</body>
</html>
