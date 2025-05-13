@extends('layouts.app')
@section('title')
    تسجيل عضور جديد
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
            <form action="{{ route('register') }}" class="custom-form" method="POST">
                @csrf
                <h1 class="font-md title-color fw-600">تسجيل حساب جديد</h1>
                @include("front.messages")
                <!-- Email Input start -->
                <div class="input-box">
                    <input type="text" placeholder="الاسم كاملاً" value="{{ old('name') }}" class="form-control"
                        name="name" />
                    <i class="ri-user-3-line icli"></i>
                </div>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="input-box">
                    <i class="ri-smartphone-line icli"></i>
                    <input type="number" placeholder="0555555555" value="{{ old('mobile') }}" class="form-control"
                        name="mobile" />
                </div>
                @error('mobile')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <!-- Email Input End -->

                <!-- Email Input start -->
                <div class="input-box">
                    <input type="email" placeholder="البريد الالكتروني - غير إلزامي" value="{{ old('email') }}"
                        class="form-control" name="email" />
                    <i class="ri-at-line icli"></i>
                </div>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <!-- Email Input End -->

                <!-- Password Input start -->
                <div class="input-box">
                    <input type="password" placeholder="كلمة المرور" class="form-control" name="password" />
                    <i class="ri-lock-2-line icli showHidePassword"></i>
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="input-box">
                    <input type="password" placeholder="إعادة كلمة المرور" class="form-control"
                        name="password_confirmation" />
                    <i class="ri-lock-2-line icli showHidePassword"></i>
                </div>
                <!-- Password Input End -->

                {{-- </form> --}}
                <div class="input-box my-3 text-start ">

                    <label class="flex" for="radio13"><input @if (old('agree') == 1) checked @endif
                            type="checkbox" name="agree" id="radio13" value="1">
                        قرأت وأوافق على <a class="url_link" href="#">الشروط والأحكام</a> و<a class="url_link"
                            href="#">سياسة الخصوصية</a> لمنصة قطرة. </label>
                </div>
                @error('agree')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                {{-- <form action="{{ route('otp') }}" class="custom-form"> --}}
                <button type="submit" class="btn-solid w-100">تسجيل</button>
            </form>
            <span class="content-color font-sm d-block text-center fw-600">هل لديك حساب بالفعل ؟ <a
                    href="{{ route('login') }}" class="underline">دخول </a></span>
            <!-- Login Form End -->


        </section>
        <!-- Login Section End -->
    </main>
@endsection
@section('js')
@endsection
