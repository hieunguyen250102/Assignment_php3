<!DOCTYPE html>
<html lang="zxx">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>THERANKME - @yield('title-page')</title>

    <!-- ::::::::::::::Favicon icon::::::::::::::-->
    <link rel="shortcut icon" href="{{asset('/images/favicon.ico')}}" type="image/png">

    <!-- ::::::::::::::All CSS Files here :::::::::::::: -->
    <!-- Vendor CSS -->
    <!-- <link rel="stylesheet" href="{{asset('/css/vendor/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/vendor/ionicons.css')}}">
    <link rel="stylesheet" href="{{asset('/css/vendor/simple-line-icons.css')}}">
    <link rel="stylesheet" href="{{asset('/css/vendor/jquery-ui.min.css')}}"> -->

    <!-- Plugin CSS -->
    <!-- <link rel="stylesheet" href="{{asset('/css/plugins/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/plugins/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/plugins/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('/css/plugins/venobox.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/plugins/jquery.lineProgressbar.css')}}">
    <link rel="stylesheet" href="{{asset('/css/plugins/aos.min.css')}}"> -->

    <!-- Main CSS -->
    <!-- <link rel="stylesheet" href="{{asset('/sass/style.css')}}"> -->

    <!-- Use the minified version files listed below for better performance and remove the files listed above -->
    <link rel="stylesheet" href="{{asset('/css/vendor/vendor.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/plugins/plugins.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/style.min.css')}}">

</head>

<body>
    @include('layout.client.header')
    @yield('content')
    @include('layout.client.footer')
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="{{asset('/js/vendor/vendor.min.js')}}"></script>
    <script src="{{asset('/js/plugins/plugins.min.js')}}"></script>

    <!-- Main JS -->
    <script src="{{asset('/js/main.js')}}"></script>
</body>



</html>