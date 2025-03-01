<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home | E-Shopper</title>
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="{{asset('/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- <link href="css/font-awesome.min.css" rel="stylesheet"> -->
    <link href="{{asset('/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- <link href="css/prettyPhoto.css" rel="stylesheet"> -->
    <link href="{{asset('/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <!-- <link href="css/price-range.css" rel="stylesheet"> -->
    <link href="{{asset('/frontend/css/price-range.css')}}" rel="stylesheet">
    <!-- <link href="css/animate.css" rel="stylesheet"> -->
    <link href="{{asset('/frontend/css/animate.css')}}" rel="stylesheet">
    <!-- <link href="css/main.css" rel="stylesheet"> -->
    <link href="{{asset('/frontend/css/main.css')}}" rel="stylesheet">
    <!-- <link href="css/responsive.css" rel="stylesheet"> -->
    <link href="{{asset('/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <!-- <link href="css/prettyPhoto.css" rel="stylesheet"> -->
    <link href="{{asset('/frontend/css/responsive.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <!-- <link rel="shortcut icon" href="images/ico/favicon.ico"> -->
    <link href="{{asset('/frontend/images/ico/favicon.ico')}}" rel="shortcut icon">
    <!-- <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png"> -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
        href="{{asset('/frontend/images/ico/apple-touch-icon-144-precomposed.png')}}">
    <!-- <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png"> -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
        href="{{asset('/frontend/images/ico/apple-touch-icon-144-precomposed.png')}}">
    <!-- <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png"> -->
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
        href="{{asset('/frontend/images/ico/apple-touch-icon-72-precomposed.png')}}">
    <!-- <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png"> -->
    <link rel="apple-touch-icon-precomposed"
        href="{{asset('/frontend/images/ico/apple-touch-icon-57-precomposed.png')}}">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


</head><!--/head-->

<body>

    @include('frontend.layouts.header')

    @if (Route::currentRouteName() == 'index')
        @include('frontend.layouts.slide')
    @endif

    <section>
        <div class="container">
            <div class="row">
                @if (Str::contains(Route::currentRouteName(), 'account'))
                    @include('frontend.layouts.menu-account-left')
                @elseif (Route::currentRouteName() != 'member.login' && Route::currentRouteName() != 'member.register' && !Str::contains(Route::currentRouteName(), 'cart'))
                    @include('frontend.layouts.menu-left')
                @endif

                <!-- tim cach lay router name, cai nao co account thi ... -->
                @yield('content')
            </div>
    </section>
    @include('frontend.layouts.footer')


    <!-- <script src="js/jquery.js"></script> -->
    <script src="{{asset('/frontend/js/jquery.js')}}"></script>
    <!-- <script src="js/bootstrap.min.js"></script> -->
    <script src="{{asset('/frontend/js/bootstrap.min.js')}}"></script>
    <!-- <script src="js/jquery.scrollUp.min.js"></script> -->
    <script src="{{asset('/frontend/js/scrollUp.min.js')}}"></script>
    <!-- <script src="js/price-range.js"></script> -->
    <script src="{{asset('/frontend/js/price-range.js')}}"></script>
    <!-- <script src="js/jquery.prettyPhoto.js"></script> -->
    <script src="{{asset('/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <!-- <script src="js/main.js"></script> -->
    <script src="{{asset('/frontend/js/main.js')}}"></script>

    @yield('js')

    <!-- @yield('layout-js') -->
</body>

</html>