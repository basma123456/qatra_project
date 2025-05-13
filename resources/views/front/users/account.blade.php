@extends('layouts.app')
@section('title') 
حسابي
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
                    <a href="{{ route("user.account") }}"> <img src="{{ url("") }}/assets/images/avatar/avatar.jpg" alt="avatar" /></a>
                    <div class="media-body">
                        <a href="{{ route("user.account") }}" class="title-color">{{ $user->name }}
                            <span class="content-color font-sm">{{ $user->mobile }}</span>
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
                    <a href="{{ route("user.favorites") }}" class="nav-link title-color font-sm">
                        <i class="ri-map-pin-range-line icli"></i>
                        <span>المساجد المفضلة</span>
                    </a>
                    <a href="{{ route("user.favorites") }}" class="arrow"><i data-feather="chevron-right"></i></a>
                </li>

                

                <li>
                    <a href="{{ route("notification") }}" class="nav-link title-color font-sm">
                        <i class="ri-notification-3-line icli"></i>
                        <span>خيارات الإشعارات</span>
                    </a>
                    <a href="{{ route("notification") }}" class="arrow"><i data-feather="chevron-right"></i></a>
                </li>

                <li>
                    <a href="{{ route("user.profile") }}" class="nav-link title-color font-sm">
                        <i class="ri-settings-2-line icli"></i>
                        <span>بيانات الحساب</span>
                    </a>
                    <a href="{{ route("user.profile") }}" class="arrow"><i data-feather="chevron-right"></i></a>
                </li>
                <li>
                    <a href="{{ route('lang') }}" class="nav-link title-color font-sm">
                        <i class="ri-global-line"></i>
                        <span>اللغة</span>
                    </a>
                    <a href="{{ route("user.profile") }}" class="arrow"><i data-feather="chevron-right"></i></a>
                </li>

                
            </ul>
            <!-- Navigation End -->
            <a href="{{ route("logout") }}" class="log-out"><i class="ri-logout-box-r-line icli"></i></i>خروج</a>
        </div>
    </main>
@endsection
@section('js')
@endsection
