@extends('layouts.app')
@section('title')
@endsection
@section('css')
@endsection
@section('skeleton')
@endsection
@section('content')
    <main class="main-wrap account-page mb-xxl">
        <div class="account-wrap section-b-t">
            <div class="user-panel">
                <div class="media">
                    <a href="{{ route("account") }}"> <img src="assets/images/avatar/avatar.jpg" alt="avatar" /></a>
                    <div class="media-body">
                        <a href="{{ route("account") }}" class="title-color">محمد الغامدي
                            <span class="content-color font-sm">ghamdi.m@gmail.com</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Navigation Start -->
            <ul class="navigation">
            

                <li>
                    <a href="{{ route("front.orders") }}" class="nav-link title-color font-sm">
                        <i class="ri-bill-line icli"></i>
                        <span>طلباتي</span>
                    </a>
                    <a href="{{ route("front.orders") }}" class="arrow"><i data-feather="chevron-right"></i></a>
                </li>

                <li>
                    <a href="{{ route("wishlist") }}" class="nav-link title-color font-sm">
                        <i class="ri-map-pin-range-line icli"></i>
                        <span>المساجد المفضلة</span>
                    </a>
                    <a href="{{ route("wishlist") }}" class="arrow"><i data-feather="chevron-right"></i></a>
                </li>

                

                <li>
                    <a href="{{ route("notification") }}" class="nav-link title-color font-sm">
                        <i class="ri-notification-3-line icli"></i>
                        <span>الإشعارات</span>
                    </a>
                    <a href="{{ route("notification") }}" class="arrow"><i data-feather="chevron-right"></i></a>
                </li>

                <li>
                    <a href="{{ route("setting") }}" class="nav-link title-color font-sm">
                        <i class="ri-settings-2-line icli"></i>
                        <span>الإعدادات</span>
                    </a>
                    <a href="{{ route("setting") }}" class="arrow"><i data-feather="chevron-right"></i></a>
                </li>

                
            </ul>
            <!-- Navigation End -->
            <button class="log-out" data-bs-toggle="offcanvas" data-bs-target="#confirmation"
                aria-controls="confirmation"><i class="ri-logout-box-r-line icli"></i></i>خروج</button>
        </div>
    </main>
@endsection
@section('js')
@endsection
