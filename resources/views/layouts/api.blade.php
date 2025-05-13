<!DOCTYPE html>
<html lang="en">
<!-- Head Start -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>@yield("title") - Qatra </title>
    <meta name="theme-color" content="#00a0df" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="apple-mobile-web-app-title" content="Fastkart" />
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <style>
        .logo {
            width: calc(100px + (130 - 100) * ((100vw - 320px) / (1920 - 320)));
        }
    </style>
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" id="rtl-link" type="text/css"
        href="{{ url('') }}/assets/css/vendors/bootstrap.css" />

    <!-- Iconly Icon css -->
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/iconly.css" />
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/fonts/remixicon/remixicon.css" />

    <!-- Slick css -->
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/vendors/slick.css" />
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/vendors/slick-theme.css" />

    <!-- Style css -->
    <link rel="stylesheet" id="change-link" type="text/css" href="{{ url('') }}/assets/css/style.css" />
    @yield('css')
    <style>
        .footer-wrap {
            background-color: #53a3d6;
        }
    </style>
    <script>
        var base_url= "{{ url("") }}";
    </script>
    <base href='{{ url("") }}' />
</head>
<!-- Head End -->

<!-- Body Start -->

<body>
    
    
    


    <!-- Main Start -->
    @yield('content')
    <!-- Main End -->

    <!-- Footer Start -->
    
    <!-- Pwa Install App Popup End -->

    <!-- jquery 3.6.0 -->
    <script src="{{ url('') }}/assets/js/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap Js -->
    <script src="{{ url('') }}/assets/js/bootstrap.bundle.min.js"></script>

    <!-- Lord Icon -->
    <script src="{{ url('') }}/assets/js/lord-icon-2.1.0.js"></script>

    <!-- Feather Icon -->
    <script src="{{ url('') }}/assets/js/feather.min.js"></script>

    <!-- Slick Slider js -->


    <!-- Add To Home  js -->
    {{-- <script src="{{ url('') }}/assets/js/homescreen-popup.js"></script> --}}
    @yield('js')
    <!-- Theme Setting js -->
    <script src="{{ url('') }}/assets/js/theme-setting.js?v={{ time() }}"></script>

    <!-- Script js -->
    <script src="{{ url('') }}/assets/js/script.js?v=4"></script>

</body>
<!-- Body End -->

</html>
