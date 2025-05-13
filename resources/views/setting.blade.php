@extends('layouts.app')
@section('title')
@endsection
@section('css')
@endsection
@section('skeleton')
@endsection
@section('content')
    <main class="main-wrap setting-page mb-xxl">
        <div class="user-panel">
            <div class="media">
                <div class="avatar-wrap">
                    <a href="javascript:void(0)"> <img src="{{ url("") }}/assets/images/avatar/avatar.jpg" alt="avatar" /></a>
                    <span class="edit"> <i data-feather="edit-3"></i></span>
                </div>
                <div class="media-body">
                    <h2 class="title-color">محمد الغامدي</h2>
                    <span class="content-color font-md">xxxxxxx@gmail.com</span>
                </div>
            </div>
        </div>

        <!-- Form Section Start -->
        <form class="custom-form">
            <div class="input-box">
                <i class="ri-user-3-line icli"></i>
                <input type="text" placeholder="محمد الغامدي" class="form-control" required />
            </div>

            <div class="input-box">
                <i class="ri-at-line"></i>
                <input type="email" placeholder="xxxxxxx@gmail.com" class="form-control" required />
            </div>

            <div class="input-box">
                <i class="ri-smartphone-line icli"></i>
                <input type="number" placeholder="0555555555" class="form-control" required />
            </div>

            <div class="input-box">
                <i class="ri-calendar-line icli"></i>
                <input class="datepicker-here form-control digits" type="text" autocomplete="off" data-language="en"
                    data-multiple-dates-separator=", " placeholder="28/12/1990" />
            </div>
            <button type="submit" class="btn-solid">تحديث</button>
        </form>

        <form class="custom-form mt-5" style="margin-bottom:6rem; ">
            <div class="input-box">
                <h3>تغيير كلمة المرور</h3>
            </div>
            <div class="input-box">
                <i class="ri-lock-2-line icli"></i>
                <input type="text" placeholder="كلمة المرور السابقة" class="form-control" required />
            </div>
            <div class="input-box">
                <i class="ri-lock-2-line icli"></i>
                <input type="text" placeholder="كلمة المرور الجديدة" class="form-control" required />
            </div>
            <div class="input-box">
                <i class="ri-lock-2-line icli"></i>
                <input type="text" placeholder="إعادة كلمة المرور الجديدة" class="form-control" required />
            </div>

            

            <button type="submit" class="btn-solid">حفظ</button>
        </form>
        <!-- Form Section End -->
    </main>
@endsection
@section('js')
@endsection
