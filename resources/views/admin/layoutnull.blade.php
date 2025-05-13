<!DOCTYPE html>
<html lang="en" class="light-style" dir="rtl" data-theme="theme-default"
    data-assets-path="{{ url('admin') }}/assets/" data-template="horizontal-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title')</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ url('admin') }}/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="{{ url('admin') }}/assets/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="{{ url('admin') }}/assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="{{ url('admin') }}/assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ url('admin') }}/assets/vendor/css/rtl/core.css"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ url('admin') }}/assets/vendor/css/rtl/theme-default.css"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ url('admin') }}/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet"
        href="{{ url('admin') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="{{ url('admin') }}/assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="{{ url('admin') }}/assets/vendor/libs/apex-charts/apex-charts.css" />
    <link rel="stylesheet" href="{{ url('admin') }}/assets/vendor/libs/select2/select2.css" />
    <link rel="stylesheet" href="{{ url('admin') }}/assets/vendor/libs/sweetalert2/sweetalert2.css" />



    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ url('admin') }}/assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    {{-- <script src="{{ url('admin') }}/assets/vendor/js/template-customizer.js"></script> --}}
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ url('admin') }}/assets/js/config.js"></script>
    @yield('css')
</head>

<body>
    <!-- Layout wrapper -->
    <div class="container-fluid">
        @yield('content')
    </div>
    {{-- <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
        <div class="layout-container">
            <!-- Navbar -->



            <!-- / Navbar -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Content wrapper -->
                <div class="content-wrapper">


                    <!-- Content -->




                    <!--/ Content -->

                    <!-- Footer -->

                    <!-- / Footer -->
                </div>
                <!--/ Content wrapper -->
            </div>

            <!--/ Layout container -->
        </div>
    </div> --}}

    <!-- Overlay -->
    {{-- <div class="layout-overlay layout-menu-toggle"></div> --}}

    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    {{-- <div class="drag-target"></div> --}}

    <!--/ Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js {{ url('admin') }}/assets/vendor/js/core.js -->
    <script src="{{ url('admin') }}/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ url('admin') }}/assets/vendor/libs/popper/popper.js"></script>
    <script src="{{ url('admin') }}/assets/vendor/js/bootstrap.js"></script>
    <script src="{{ url('admin') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="{{ url('admin') }}/assets/vendor/libs/hammer/hammer.js"></script>

    <script src="{{ url('admin') }}/assets/vendor/libs/i18n/i18n.js"></script>
    <script src="{{ url('admin') }}/assets/vendor/libs/typeahead-js/typeahead.js"></script>

    <script src="{{ url('admin') }}/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    {{-- <script src="{{ url('admin') }}/assets/vendor/libs/apex-charts/apexcharts.js"></script> --}}

    <!-- Main JS -->
    <script src="{{ url('admin') }}/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="{{ url('admin') }}/assets/js/dashboards-analytics.js"></script>
    <script src="{{ url('admin') }}/assets/vendor/libs/select2/select2.js"></script>
    <script src="{{ url('admin') }}/assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="{{ url('admin') }}/assets/js/extended-ui-sweetalert2.js"></script>


    @yield('js')

</body>

</html>
