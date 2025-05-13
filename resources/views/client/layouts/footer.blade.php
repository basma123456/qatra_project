<!--Footer-->
<x-client.layouts.footer/>


<!--Bootstrap cdn -->
<script src="{{asset('client/js/bootstrap.bundle.min.js')}}"></script>

<!--Swiper-->
<script src="{{asset('client/js/swiper-bundle.js')}}"></script>

<!--Animation-->
<script src="{{asset('client/js/wow.min.js')}}"></script>

<!--select2-->
<script src="{{asset('client/js/select2.js')}}"></script>

<!--Custom Script-->
<script src="{{asset('client/js/main.js')}}"></script>

@livewireScripts

@yield('script')

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
