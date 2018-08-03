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
    <link href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('bower_components/Font-Awesome/web-fonts-with-css/css/fontawesome-all.min.css') }}">
</head>
<body class="stretched">
    <div id="wrapper" class="clearfix">
        @include('shared.navbar')
        @yield('content')
    </div>
    <script src="{{ asset('bower_components/jquery/dist/jquery.js') }}"></script>
    <script src="{{ asset('bower_components/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/functions.js') }}"></script>
    <script src="{{ asset('bower_components/ckeditor/ckeditor.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        };
    </script>
    <script>
        CKEDITOR.replace('my-editor', options);
    </script>
</body>
</html>
