<?php
 $store = \App\Models\Setting::first();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset('file')}}/{{$store->favicon}}" type="image/png">
    <title>{{ trans('panel.site_title') }}</title>

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet" />

    <link href="{{ asset('assets/vendor/css/adminltev3.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendor/css/icheck-bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.css') }}" rel="stylesheet" />
    

    <style>
        .form-control,
        .btn,
        a {
            outline: none !important;
            box-shadow: none !important;
        }

        #cover {
            background: url("{{asset('frontend/images/loading.gif')}}") no-repeat scroll center center #FFF;
            position: absolute;
            height: 100%;
            width: 100%;
        }



    </style>

    @yield('styles')
</head>

<body class="header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden login-page">
    <div id="cover"></div>
    @yield('content')
    @yield('scripts')
    <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
    <script>
        $(window).on('load', function(){
                $('#cover').fadeOut(1000);
        });
    </script>
</body>

</html>
