@extends('layouts.app')
@section('title')
    تسجيل الدخول
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <style>
        .iti {
            width: 100%;
        }

        .iti-mobile .iti__country-list {
            width: 90%;
        }
    </style>
@endsection
@section('skeleton')
@endsection
@section('back_url', route('front.home'))
@section('content')
    <main class="main-wrap login-page mb-xxl">
        <!-- Login Section Start -->
        <section class="login-section p-0">
            <!-- Login Form Start -->
            <form action="{{ route('login') }}" method="POST" class="custom-form" id="form_login">
                @csrf
                <h1 class="font-md title-color fw-600">تسجيل الدخول</h1>
                @include('front.messages')
                <!-- Email Input start -->
                <div class="input-box">
                    <input type="number" class="form-control mobile" name="mobile1" id="mobile" style="direction: ltr"
                        value="{{ old('mobile1') }}" />
                    {{-- <input id="phone" type="tel" name="phone" /> --}}
                </div>

                @error('mobile')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <!-- Email Input End -->
                <button type="button" id="submit_form" class="btn-solid">دخول</button>
                <input id="countryData" name="mobile" value="" type="hidden" />
            </form>
            <!-- Login Form End -->

        </section>
        <!-- Login Section End -->
    </main>
    <div class="offcanvas offcanvas-bottom addtohome-popup notification-popup" tabindex="-1" id="notification-popup">
        <div class="offcanvas-body small">
            <div class="app-info">
                <div class="content">
                    <h3>تنبيه <i data-feather="x" data-bs-dismiss="offcanvas"></i></h3>
                </div>
            </div>
            <p class="my-2" id="notification-text"></p>
            <button class="btn-solid install-app" data-bs-dismiss="offcanvas">إغلاق</button>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script>
        var phoneInputField = document.querySelector("#mobile");
        var phoneInput = window.intlTelInput(phoneInputField, {
            preferredCountries: ['sa', 'ae', 'kw', 'qa', 'bh', 'om'],
            separateDialCode: true,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            initialCountry: "auto",
            geoIpLookup: function(success, failure) {
                fetch("https://ipapi.co/json")
                    .then(function(res) { return res.json(); })
                    .then(function(data) { success(data.country_code); })
                    .catch(function() { failure(); });
            }
        });
        // $("#form_login").on("submit", function(e) {
        //     e.preventDefault
        //     // $("#submit_form").trigger("click");
        //     return false;
        // });
        $(document).ready(function() {
            $(window).keydown(function(event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
            $("#submit_form").on("click", function(e) {
                var full_number = phoneInput.getNumber(intlTelInputUtils.numberFormat.E164);
                var isValid = phoneInput.isValidNumber();
                $("#countryData").val(full_number);
                if (isValid) {
                    $(this).attr('disabled', 'disabled');
                    $(this).html(
                        '<div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>'
                    );
                    $(this).parents('form').submit();
                } else {
                    var msg = "رقم الجوال المدخل غير صحيح";
                    $("#notification-text").html(msg);
                    var myOffcanvas = document.getElementById('notification-popup')
                    var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas)
                    bsOffcanvas.show()
                }
            });
        });
    </script>
@endsection
