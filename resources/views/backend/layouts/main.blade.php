<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ trans('message.manager') }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <base href="{{ asset('/') }}" >
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap3/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/Font-Awesome/web-fonts-with-css/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/linearicons/dist/web-font/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/datatables/media/css/dataTables.bootstrap.min.css') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('admin_assets/img/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/date-picker/datepicker.css') }}" type="text/css"/>
    <link href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('bower_components/jqueryui-datepicker/datepicker.css') }}" type="text/css"/>
</head>

<body>
    <div id="wrapper">
        @include('backend.layouts.navbar')
        @include('backend.layouts.sidebar')

        <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
             <!-- END CONTENT -->
        </div>
    </div>
    <!-- END WRAPPER -->
    <!-- Javascript -->
    <script src="{{ asset('js/admin.js') }}"></script>
    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap3/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables/media/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('bower_components/date-picker/core.js') }}"></script>
    <script src="{{ asset('bower_components/date-picker/datepicker.js') }}"></script>
    <script src="{{ asset('bower_components/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('bower_components/jqueryui-datepicker/core.js') }}"></script>
    {{-- <script src="{{ asset('bower_components/date-picker/datepicker.js') }}"></script> --}}
    <script src="{{ asset('bower_components/jqueryui-datepicker/datepicker.js') }}"></script>
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
    @yield('script')
</body>

</html>
