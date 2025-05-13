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
            <form action="#" class="custom-form">
                <h1 class="font-md title-color fw-600">تسجيل الدخول</h1>
                <div class="alert alert-warning" role="alert">
                    عفواً. هذه الخاصية متاحة للأعضاء المسجلين فقط
                  </div>
                <!-- Email Input start -->
                <div class="input-box">
                    <i class="ri-smartphone-line icli"></i>
                    <input type="number" placeholder="0555555555" class="form-control" required />
                </div>
                <!-- Email Input End -->

                <!-- Password Input start -->
                <div class="input-box">
                    <input type="password" placeholder="كلمة المرور" required class="form-control" />
                    <i class="ri-lock-2-line icli showHidePassword"></i>
                </div>
                <!-- Password Input End -->
                <a href="{{ route("forgot") }}" class="content-color font-sm forgot mb-3">نسيت كلمة المرور ؟</a>
                <button type="submit" class="btn-solid">دخول</button>
                <a href="{{ route("register") }}" class="btn btn-outline-primary w-100">إنشاء حساب جديد </a>
                {{-- <span class="content-color font-sm d-block text-center fw-600">ليس لديك حساب ؟ <a 
                        class="underline">إنشاء حساب </a></span> --}}
            </form>
            <!-- Login Form End -->

        </section>
        <!-- Login Section End -->
    </main>
@endsection
@section('js')
@endsection
