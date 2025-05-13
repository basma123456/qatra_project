<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>qatraa</title>

    <link rel="icon" href="{{ asset('client/img/logo.png') }}" type="image/png" />
    <!--Bootstrap cdn -->
    <link rel="stylesheet" href="{{asset('client/css/bootstrap.min.css')}}" />
    <!--Font awsome-->
    <link href="{{url('https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css')}}" rel="stylesheet" />

    <!--Animation -->
    <link rel="stylesheet" href="{{asset('client/css/animate.css')}}" />
    <!--Swiper-->
    <link rel="stylesheet" href="{{asset('client/css/swiper.min.css')}}" />
    <link rel="stylesheet" href="{{asset('client/css/swiper-bundle.min.css')}}" />

    <!-- Custom Stylsheet-->
    <link rel="stylesheet" href="{{asset('client/css/style.css?v=0.0.18')}}" />
    <link rel="stylesheet" href="{{asset('client/css/custom.css?v=0.0.18')}}" />

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @livewireStyles

    @yield('style')


    <style>
        .price:focus-visible {
            border: none !important;
        }
        .linkable:hover {
            cursor: pointer;
        }
        /*<!-----spinner --->*/
        /* Button styling */
        button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }
        /* Loading spinner */
        .spinner {
            border: 10px solid rgba(255, 255, 255, 0.3);
            border-top: 10px solid orange;
            border-radius: 50%;
            width: 100px;
            height: 100px;
            animation: spin 1s linear infinite;
            margin-top: 10px;
        }

        /* Keyframes for spinner animation */
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>
<body>
