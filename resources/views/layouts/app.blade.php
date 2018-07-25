<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('bower_components/lato-font/css/lato-font.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('bower_components/raleway/raleway.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('css/swiper.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('css/dark.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('css/font-icons.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css' ) }}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}" type="text/css"/>
</head>
<body class="stretched">
    <div id="wrapper" class="clearfix">
        @include('shared.navbar')
        @yield('content')
    </div>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/functions.js') }}"></script>
</body>
</html>
