@extends('layouts.app')
@section('title')
@endsection
@section('css')
<style>
    .login-page .login-section .countdown .otp-input input{
        width: 22%;
    }
</style>
@endsection
@section('skeleton')
@endsection
@section('content')
    <main class="main-wrap login-page mb-xxl">

        <p class="content-color font-sm">تم إرسال رسالة على جوالك تحتوي رمز التحقق</p>
        <span class="font-md">
            +966501293746 </span>

        <!-- Login Section Start -->
        <section class="login-section p-0">
            <!-- Login Form Start -->
            <form action="{{ route("account") }}" class="custom-form">
                <h1 class="font-md title-color fw-600">ادخل رمز التحقق</h1>

                <div class="countdown mb-md">
                    <div class="input-box otp-input">
                        <input class="otp form-controll" placeholder="0" type="text" 
                            oninput="digitValidate(this)" onkeyup="tabChange(1)" maxlength="1" />
                        <input class="otp form-controll" placeholder="0" type="text" 
                            oninput="digitValidate(this)" onkeyup="tabChange(2)" maxlength="1" />
                        <input class="otp form-controll" placeholder="0" type="text" 
                            oninput="digitValidate(this)" onkeyup="tabChange(3)" maxlength="1" />
                        <input class="otp form-controll" placeholder="0" type="text" 
                            oninput="digitValidate(this)" onkeyup="tabChange(4)" maxlength="1" />
                    </div>
                </div>
                <button type="submit" class="btn-solid">إرسال</button>
                <!-- Count Down Start -->
                <div class="otp-countdown text-center">
                    <div class="content-color">
                        <a href="javascript:void(0)" class="resend-otp">إعادة إرسال رمز التحقق </a> <span class="time"> خلال <span
                                id="timer"></span></span>
                    </div>
                </div>
                <!-- Count Down End -->
            </form>
            <!-- Login Form End -->
        </section>
        <!-- Login Section End -->
    </main>
@endsection
@section('js')
<script src="{{ url("") }}/assets/js/otp.js"></script>
@endsection
