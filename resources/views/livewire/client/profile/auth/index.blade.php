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

    @if($show_auth)
    @if(!auth()->user())
    <div class="User mt-5">
        <div class="Btns d-flex p-3">
            <button class="btn btn_user @if(!$new_donor) active @endif" wire:click="updateNewDonor(0)" id="old_User">
                تسجيل دخول
            </button>
            <button class="btn btn_user @if($new_donor) active @endif" wire:click="updateNewDonor(1)" id="new_User"> إنشاء حساب </button>
        </div>

        <form class="form_User p-3 mb-3" id="old_form" @if($new_donor) style="display:none" @endif>
            <div class="mb-3" wire:ignore>
                <label class="form-label"> الجوال </label>
                <input type="number" class="form-control mobile" wire:model="mobile" value="{{ $mobile }}" wire:ignore id="mobile" style="direction: ltr" />
                <input id="countryData" wire:model="mobileWithCode" wire:ignore value="" {{ $mobileWithCode }} type="hidden" />
                @error('mobile')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <span class="text-danger" id="notification-login"></span>
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
            <div class="text-center">
                <button type="button" class="btn btn-save submit_form" value="login">
                    إرسال
                </button>
            </div>
        </form>

        <form class="form_User p-3 mb-3" id="new_form" @if(!$new_donor) style="display:none" @endif>
            <div class="mb-3">
                <label class="form-label">الأسم* </label>
                <input type="text" wire:model="name" class="form-control" />
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3" wire:ignore>
                <label class="form-label">الجوال* </label>
                <input type="number" class="form-control mobile" wire:model="mobile" value="{{ $mobile }}" wire:ignore id="mobileRegister" style="direction: ltr" />
                <input id="countryData" wire:model="mobileWithCode" wire:ignore value="" {{ $mobileWithCode }} type="hidden" />
                @error('mobile')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <span class="text-danger" id="notification-register"></span>
                @error('mobile')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label"> الإيميل </label>
                <input type="text" wire:model="email" class="form-control" />
                @error('email')
                <span class="text-danger">{{ $message }}</span>
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

            <div class="text-center">
                <button type="button" class="btn btn-save submit_form" value="register">إرسال</button>
            </div>
        </form>

    </div>
    @endif

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
    @endif



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


        // Loop through all mobile number inputs in the form
        var phoneInputRegister = document.querySelector("#mobileRegister");
        var phoneInputRegister = window.intlTelInput(phoneInputRegister, {
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
                $("#notification-register").html("");

                if ($(this).val() == "login") {
                    var full_number = phoneInput.getNumber(intlTelInputUtils.numberFormat.E164);
                    var isValid = phoneInput.isValidNumber();
                } else {
                    var full_number = phoneInputRegister.getNumber(intlTelInputUtils.numberFormat.E164);
                    var isValid = phoneInputRegister.isValidNumber();
                }
                $("#countryData").val(full_number);
                if (isValid) {
                    if ($(this).val() == "login") {
                        Livewire.emit('login', full_number);
                    } else {
                        Livewire.emit('register', full_number);
                    }
                } else {
                    var msg = "رقم الجوال المدخل غير صحيح";
                    if ($(this).val() == "login") {
                        $("#notification-login").html(msg);
                    } else {
                        $("#notification-register").html(msg);
                    }
                }
            });
        });

    </script>
</div>
