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
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" type="text/css"/>
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
    <script src="{{ asset('bower_components/typeahead.js/dist/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/functions.js') }}"></script>
    <script src="{{ asset('js/search.js') }}"></script>
    <script src="{{ asset('bower_components/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('bower_components/pusher-js/dist/web/pusher.min.js') }}"></script>
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        };
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            fetch_noti_count();
            fetch_noti_list();
            function fetch_noti_count() {
                $.ajax({
                    url: "{{ url('notification/fetch_noti_count') }}",
                    method: 'POST',
                    dataType: 'JSON',
                    success: function(data)
                    {
                        // console.log(data);
                        $('#noti-count').html(data);
                    }
                })
            }

            function fetch_noti_list() {
                var i;
                var content = '';
                var html ='';
                $.ajax({
                    url: "{{ url('notification/fetch_noti_list') }}",
                    method: 'POST',
                    dataType: 'JSON',
                    success: function(data)
                    {
                        //0 = from_user_name
                        //1 = type
                        //2 = type_id
                        //3 = diff_time
                        //4 = diff_type
                        //5 = avatar
                        // console.log(data);
                        for (i = 0; i < data.length; i++) {
                            if (data[i][1] == 'replied') {
                                content = ' to a comment you made';
                            } else if (data[i][1] == 'commented') {
                                content = ' on your review';
                            }
                            html = '<li class="headerNotify_item">' +
                                        '<div class="headerNotify_block-img">' +
                                            '<img class="headerNotify_pic" src="' + data[i][5] + '">' +
                                        '</div>' +
                                        '<div class="headerNotify_block-txt">' +
                                            '<em class="headerNotify_em">' + data[i][0] + '</em>' + ' ' + data[i][1] + content +
                                        '</div>' +
                                        '<div class="headerNotify_block-time">' + data[i][3] + ' ' + data[i][4] + ' ago' +
                                    '</li>';
                            $('#noti-list').append(html);
                        }
                    }
                })
            }
        });
    </script>

    <script type="text/javascript">
        if ( "{{ Auth::check() }}") {
            Pusher.logToConsole = true;
            var pusher_review_commented = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
                encrypted: true,
                cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
            });

            var channel = pusher_review_commented.subscribe('review-commented');
            channel.bind('App\\Events\\ReviewCommented', function(data) {
                console.log(data['result']);
                if ( "{{ Auth::id() }}" == data['to_user_id']) {
                    $('#noti-count').html(data['count']);
                }
                // $('#noti-list').append(data['message']);
            });
        }
    </script>
    @yield('script')
</body>
</html>
