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
                <div class="User login_form rounded mx-auto  mx-auto border p-3 mb-4">
                    <div class="head py-3 rounded-3">
                        <h4>تسجيل الدخول</h4>
                    </div>
                    <div class="body my-3 d-flex flex-column align-items-center">
      

                        <div class="form_User w-75 mb-2">
                            <div class="mb-3 text-end" wire:ignore>
                                <label class="form-label">الجوال* </label>
                                <input type="number" class="form-control mobile" wire:model="mobile" value="{{ $mobile }}" wire:ignore id="mobile" style="direction: ltr" />
                                <input id="countryData" wire:model="mobileWithCode" wire:ignore value="" {{ $mobileWithCode }} type="hidden" />
                                <span class="text-danger" id="notification-register"></span>
                            </div>
                            @error('mobile')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror 


                            <div class="mb-3 text-end" wire:ignore>
                                <label class="form-label">الأسم* </label>
                                <input type="text" wire:model="name" class="form-control" />
                            </div>
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror


                            <div class="mb-3 text-end" wire:ignore>
                                <label class="form-label"> الإيميل </label>
                                <input type="text" wire:model="email" class="form-control" />
                            </div>
                            @error('email')
                            <span class="text-danger">{{ $message }} </span>
                            @enderror
                        </div>
                        
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



                        <button type="button" class="d-block my-3 px-5 py-2 btn-send submit_form" value="register">
                            ارسال
                        </button>
                        <p>
                            <span> لديك حساب ؟</span>
                            <a href="{{ route('client.login') }}"> تسجيل دخول </a>
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
        var phoneInputField = window.intlTelInput(phoneInputField, {
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
                $("#notification-register").html("");
                var full_number = phoneInputField.getNumber(intlTelInputUtils.numberFormat.E164);
                var isValid = phoneInputField.isValidNumber();
                $("#countryData").val(full_number);

                if (isValid) {
                    Livewire.emit('register', full_number);
                } else {
                    var msg = "رقم الجوال المدخل غير صحيح";
                    $("#notification-register").html(msg);
                }
            });
        });

    </script>


</div>
