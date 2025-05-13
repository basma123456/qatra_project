@extends('layouts.app')
@section('title')
@endsection
@section('css')
@endsection
@section('skeleton')
@endsection
@section('content')
    <main class="main-wrap login-page mb-xxl">

        <!-- Login Section Start -->
        <section class="login-section p-0">
            <!-- Login Form Start -->
            <form action="{{ route('forgot2') }}" class="custom-form">
                <h1 class="font-md title-color fw-600">نسيت كلمة المرور</h1>

                <h2 class="font-md title-color fw-600 mb-4">ادخل رمز التحقق</h2>
                <div class="countdown mb-md">
                    <div class="input-box otp-input">
                        <input class="otp form-controll" placeholder="0" type="text" oninput="digitValidate(this)"
                            onkeyup="tabChange(1)" maxlength="1" />
                        <input class="otp form-controll" placeholder="0" type="text" oninput="digitValidate(this)"
                            onkeyup="tabChange(2)" maxlength="1" />
                        <input class="otp form-controll" placeholder="0" type="text" oninput="digitValidate(this)"
                            onkeyup="tabChange(3)" maxlength="1" />
                        <input class="otp form-controll" placeholder="0" type="text" oninput="digitValidate(this)"
                            onkeyup="tabChange(4)" maxlength="1" />
                    </div>
                </div>

                <!-- Email Input start -->
                <div class="input-box">
                    <input type="password" placeholder="كلمة المرور" class="form-control" />
                    <i class="ri-lock-2-line icli showHidePassword"></i>
                </div>
                <div class="input-box">
                    <input type="password" placeholder="إعادة كلمة المرور" class="form-control" />
                    <i class="ri-lock-2-line icli showHidePassword"></i>
                </div>
                <!-- Email Input End -->

                <button type="submit" class="btn-solid">حفظ</button>
                <span class="content-color font-sm d-block text-center fw-600"> <a href="{{ route('login') }}"
                        class="underline">تسجيل الدخول </a></span>
            </form>
            <!-- Login Form End -->
        </section>
        <!-- Login Section End -->
    </main>
@endsection
@section('js')
@endsection
