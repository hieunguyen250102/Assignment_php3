<!DOCTYPE html>
<html lang="zxx">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="_token" content="{{ csrf_token() }}">
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

    <!-- JavaScript -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />

    <!-- 
    RTL version
-->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.rtl.min.css" />
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.rtl.min.css" />
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.rtl.min.css" />
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.rtl.min.css" />
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.26/sweetalert2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script>
        function addToCart(id) {
            $.ajax({
                type: 'get',
                url: '/add-cart/' + id,
                success: function(response) {
                    $('#bag').html(response);
                    alertify.notify('Add to cart successfully!', 'success', 5, function() {
                        console.log('dismissed');
                    })
                }
            });
            $.ajaxSetup({
                headers: {
                    'csrftoken': '{{ csrf_token() }}'
                }
            });
        }
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
        });

        
        function deleteCart(id) {
            $.ajax({
                type: 'get',
                url: '/delete-cart/' + id,
                success: function(response) {
                    // $('#bag').html(response);
                    alertify.notify('Delete successfully!', 'error', 5, function() {
                        console.log('dismissed');
                    })
                }
            });
        }
    </script>
</body>



</html>