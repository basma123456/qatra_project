@extends("layouts.app")
@section("title")
@endsection
@section("css")
@endsection
@section('skeleton')
@endsection
@section("content")
<main class="main-wrap login-page mb-xxl">
   
    <!-- Login Section Start -->
    <section class="login-section p-0">
      <!-- Login Form Start -->
      <form action="{{ route("forgot2") }}" class="custom-form">
        <h1 class="font-md title-color fw-600">نسيت كلمة المرور</h1>

        <!-- Email Input start -->
        <div class="input-box">
          <input type="mobile" placeholder="الجوال" required class="form-control" />
          <i class="ri-smartphone-line"></i>
        </div>
        <!-- Email Input End -->

        <button type="submit" class="btn-solid">إرسال رمز التحقق المؤقت</button>
        <span class="content-color font-sm d-block text-center fw-600"> <a href="{{ route("login") }}" class="underline">تسجيل الدخول </a></span>
      </form>
      <!-- Login Form End -->
    </section>
    <!-- Login Section End -->
  </main>
@endsection
@section("js")
@endsection