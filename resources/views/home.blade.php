<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="Codescandy" name="author">
        <title>Cafe Sudut Temu</title>
        <link href="{{asset('assets/libs/tiny-slider/dist/tiny-slider.css')}}" rel="stylesheet">
        <link href="{{asset('assets/libs/slick-carousel/slick/slick.css')}}" rel="stylesheet">
        <link href="{{asset('assets/libs/slick-carousel/slick/slick-theme.css')}}" rel="stylesheet">
        <!-- Favicon icon-->
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/favicon/favicon.ico')}}">

        <!-- Libs CSS -->
        <link href="{{asset('assets/libs/bootstrap-icons/font/bootstrap-icons.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/libs/feather-webfont/dist/feather-icons.css')}}" rel="stylesheet">
        <link href="{{asset('assets/libs/simplebar/dist/simplebar.min.css')}}" rel="stylesheet">

        <!-- Theme CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/theme.min.css')}}">
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-M8S4MT3EYG"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
            dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'G-M8S4MT3EYG');
        </script>
        <script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/libs/simplebar/dist/simplebar.min.js')}}"></script>
    </head>
    <body>

        @include('TMP_Home.header')

        @yield('content')

        <script src="{{asset('assets/js/theme.min.js')}}"></script>
        <script src="{{asset('assets/libs/slick-carousel/slick/slick.min.js')}}"></script>
        <script src="{{asset('assets/js/vendors/slick-slider.js')}}"></script>
        <script src="{{asset('assets/libs/tiny-slider/dist/min/tiny-slider.js')}}"></script>
        <script src="{{asset('assets/js/vendors/tns-slider.js')}}"></script>
        <script src="{{asset('assets/js/vendors/zoom.js')}}"></script>
        <script src="{{asset('assets/js/vendors/increment-value.js')}}"></script>
    </body>
</html>
