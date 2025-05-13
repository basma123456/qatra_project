@extends('layouts.app')
@section('title')
    تأكيد رمز التحقق
@endsection
@section('css')
    <style>
        .login-page .login-section .countdown .otp-input input {
            width: 22%;
        }
    </style>
@endsection
@section('skeleton')
@endsection
@section('back_url', route('front.home'))
@section('content')
    <main class="main-wrap login-page mb-xxl">

        <p class="content-color font-sm">تم إرسال رسالة على جوالك تحتوي رمز التحقق</p>
        <span class="font-md">
            {{ $mobile }} </span>

        <!-- Login Section Start -->
        <section class="login-section p-0">
            <!-- Login Form Start -->
            <form action="{{ route('otp') }}" class="custom-form" method="POST" id="form_otp">

                <h1 class="font-md title-color fw-600">ادخل رمز التحقق</h1>
                @include('front.messages')
                <div class="countdown mb-md" style="direction: ltr">
                    <div class="input-box otp-input">
                        <input class="otp form-controll" placeholder="0" type="number" name="digit[]"
                            oninput="digitValidate(this)" onkeyup="tabChange(1)" maxlength="1" autofocus />
                        <input class="otp form-controll" placeholder="0" type="number" name="digit[]"
                            oninput="digitValidate(this)" onkeyup="tabChange(2)" maxlength="1" />
                        <input class="otp form-controll" placeholder="0" type="number" name="digit[]"
                            oninput="digitValidate(this)" onkeyup="tabChange(3)" maxlength="1" />
                        <input class="otp form-controll last-digit" placeholder="0" type="number" name="digit[]"
                            oninput="digitValidate(this)" onkeyup="tabChange(4)" maxlength="1" />
                    </div>
                </div>
                <button type="submit" id="submit_btn" class="btn-solid disableafterclick">إرسال</button>
                <!-- Count Down Start -->
                <div class="otp-countdown text-center">
                    <div class="content-color">
                        <a href="javascript:void(0)" id="resend-otp" data-url="{{ url('user/resend/otp') }}"
                            class="resend-otp">إعادة إرسال رمز التحقق </a> <span class="time">
                            خلال <span id="timer"></span></span>
                    </div>
                </div>
                <!-- Count Down End -->
                @csrf
            </form>
            <!-- Login Form End -->
        </section>
        <!-- Login Section End -->
    </main>
@endsection
@section('js')
    <script src="{{ url('') }}/assets/js/otp.js"></script>
    <script>
        $(".last-digit").keyup(function() {
            $("#submit_btn").trigger("click");
        });
    </script>
@endsection
