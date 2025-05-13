<div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <style>
        .iti {
            width: 100%;
        }
        .iti-mobile .iti__country-list {
            width: 90%;
        }
        .iti__country-name {
            display: none;
        }
    </style>


    <div class="container text-center">
        <div class="row justify-content-center">

            <div class="col-12 col-md-6 mx-md-auto mt-5">
                <div class="login_form rounded mx-auto text-center mx-auto border p-3 mb-4">
                    <div class="head py-3 rounded-3">
                        <h4>تسجيل الدخول</h4>
                    </div>
                    <div class="body my-3 d-flex flex-column align-items-center">
                        <h5 class="fs-6">تسجيل الدخول من خلال رقم الجوال</h5>
                        <h2 class="my-4">رقم الجوال</h2>
                        <div class="alert alert-danger d-none my-3 w-75" id="emptyInputAlert" role="alert">
                            من فضلك ادخل رقم الجوال بطريقة صحيحة
                        </div>
                       <div class="w-75 mb-2" wire:ignore >
                        <input type="number" class="form-control mobile" wire:model="mobile" value="{{ $mobile }}" wire:ignore id="mobile" style="direction: ltr" />
                        <input id="countryData" wire:model="mobileWithCode" wire:ignore value="" {{ $mobileWithCode }} type="hidden" />
                       </div>
                        @error('mobile')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <span class="text-danger" id="notification-login"></span>


                        @if($authError)
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{ $authError }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if($authMessage)
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{ $authMessage }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <button type="button" class="d-block my-3 px-5 py-2 btn-send submit_form" value="login">
                            ارسال
                        </button>
                        <p>
                            <span>ليس لديك حساب ؟</span>
                            <a href="{{ route('client.register') }}"> إنشاء حساب</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- Modal -->
    <!-- OTP Modal -->
    <div class="modal fade @if($otp_modal)show @endif" @if($otp_modal)style="display: block;" @endif id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('OTP') </h5>
                    <div class="col-md-3 text-start">
                        <button type="button" wire:click="closeModalOTP()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row text-center">
                        <div class="col-md-9">
                            <input type="text" max="4" min="4" wire:model="otp" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-success" type="button" wire:click="checkOTP()">@lang('Send') </button>
                        </div>
                        @if($otpError)
                        <h5 class="success-message text-danger mt-3">
                            <span class="message"> {{ $otpError }} </span>
                        </h5>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script>
        var phoneInputField = document.querySelector("#mobile");
        var phoneInput = window.intlTelInput(phoneInputField, {
            preferredCountries: ['sa', 'ae', 'kw', 'qa', 'bh', 'om']
            , separateDialCode: true
            , utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
            , initialCountry: "auto"
            , geoIpLookup: function(success, failure) {
                fetch("https://ipapi.co/json")
                    .then(function(res) {
                        return res.json();
                    })
                    .then(function(data) {
                        success(data.country_code);
                    })
                    .catch(function() {
                        failure();
                    });
            }
        });


        $(document).ready(function() {
            $(window).keydown(function(event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
            $(".submit_form").on("click", function(e) {
                $("#notification-login").html("");
                var full_number = phoneInput.getNumber(intlTelInputUtils.numberFormat.E164);
                var isValid = phoneInput.isValidNumber();
                console.log(full_number);
                console.log(isValid);
                $("#countryData").val(full_number);
                if (isValid) {
                    Livewire.emit('login', full_number);
                } else {
                    var msg = "رقم الجوال المدخل غير صحيح";
                        $("#notification-login").html(msg);
                }
            });
        });

    </script>


</div>
