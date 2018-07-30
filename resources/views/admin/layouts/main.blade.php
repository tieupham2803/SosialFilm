<!DOCTYPE html>
<html lang="en">
<head>
    <title>Trang quản trị | Mrso</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- VENDOR CSS -->
    <base href="{{ asset('/') }}" >
    <link rel="stylesheet" href="admin_assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    <link rel="stylesheet" href="admin_assets/vendor/linearicons/style.css">
    <link rel="stylesheet" href="admin_assets/vendor/chartist/css/chartist-custom.css">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="admin_assets/css/main.css">
    <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
    <link rel="stylesheet" href="admin_assets/css/demo.css">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.18/r-2.2.2/datatables.min.css"/>
    <!-- ICONS -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('img/favicon.png') }}"/>
    <link rel="stylesheet" type="text/css" href="admin_assets/bootstrap-datepicker/bootstrap-datepicker.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

</head>

<body>
    <div id="wrapper">
        @include('admin.layouts.navbar')
        @include('admin.layouts.sidebar')

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
    <script src="admin_assets/vendor/jquery/jquery.min.js"></script>
    <script src="admin_assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="admin_assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="admin_assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
    <script src="admin_assets/vendor/chartist/js/chartist.min.js"></script>
    <script src="admin_assets/scripts/klorofil-common.js"></script>
    <script src="admin_assets/datatables/media/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.18/r-2.2.2/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.10.0/ckeditor.js"></script>
    <script src="admin_assets/bootstrap-datepicker/bootstrap-datepicker.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    @yield('script')
</body>

</html>
