<!doctype html>
<html lang="ar" dir="rtl">
@include('admin.layouts.header')

@livewireStyles

<body data-sidebar="dark" dir="rtl"   >

<!-- Loader -->
{{-- <div id="preloader"><div id="status"><div class="spinner"></div></div></div> --}}

<!-- Begin page -->
<div id="layout-wrapper">

    <!-- Navbar ---- -->
@include('admin.layouts.navbar')


<!-- ========== Left Sidebar Start ========== -->

    @include('admin.layouts.sidebar')

<!-- Left Sidebar End -->


    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content"  >


        <div class="page-content">
        {{-- Messages  --}}


        @yield('breadcrumb')
        @include('admin.layouts.message')
        @yield('content')

        <!-- End Page-content -->

            <!-- footer -->
            @include('admin.layouts.footer')
        </div>

    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<!-- Right Sidebar -->
@include('admin.layouts.right-sidebar')

<!-- /Right-bar -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>


<!-- JAVASCRIPT -->
@include('admin.layouts.script')
@livewireScripts
<script>
    // livewire events
    Livewire.on('redirect', (event) => {
        window.location.href = event.url;
    });


    // Livewire.on('showLoadingMessage', () => {
    //     // Show the loading message when the process starts
    //     document.getElementById('loadingMessage').style.display = 'block';
    // });
    //
    // Livewire.on('hideLoadingMessage', () => {
    //     // Hide the loading message when the process is done
    //     document.getElementById('loadingMessage').style.display = 'none';
    // });
    Livewire.on('showLoadingMessage', () => {
        console.log('Loading message shown');
        document.getElementById('loadingMessage').style.display = 'block';
    });

    Livewire.on('hideLoadingMessage', () => {
        console.log('Loading message hidden');

        // Set a delay (e.g., 2000ms = 2 seconds)
        setTimeout(() => {
            document.getElementById('loadingMessage').style.display = 'none';
        }, 1000); // 2000ms = 2 seconds delay
    });
</script>

</body>
</html>
