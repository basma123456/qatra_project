@extends('layouts.app')
@section('title')
@endsection
@section('css')
    <style>
        .font-social {
            font-size: 35px;
        }

        .facebook {
            color: #4267B2;
        }

        .twitter {
            color: #1DA1F2;
        }

        .instagram {
            color: #C13584;
        }
        .snapchat {
            color: #000000;
        }
    </style>
@endsection
@section('skeleton')
@endsection
@section('content')
    <main class="main-wrap account-page mb-xxl">
        <div class="account-wrap section-b-t">


            <!-- Navigation Start -->
            <ul class="navigation pt-5">


                <li>
                    <a href="{{ route('aboutus') }}" class="nav-link title-color font-sm">
                        <i class="ri-bill-line icli"></i>
                        <span>حول قطرة خير</span>
                    </a>
                    <a href="{{ route('aboutus') }}" class="arrow"><i data-feather="chevron-right"></i></a>
                </li>
                <li>
                    <a href="{{ route('terms') }}" class="nav-link title-color font-sm">
                        <i class="ri-bill-line icli"></i>
                        <span>الشروط والأحكام </span>
                    </a>
                    <a href="{{ route('terms') }}" class="arrow"><i data-feather="chevron-right"></i></a>
                </li>
                <li>
                    <a href="{{ route('policy') }}" class="nav-link title-color font-sm">
                        <i class="ri-bill-line icli"></i>
                        <span>سياسة الخصوصية </span>
                    </a>
                    <a href="{{ route('policy') }}" class="arrow"><i data-feather="chevron-right"></i></a>
                </li>
                {{-- <li>
                    <a href="{{ route("faq") }}" class="nav-link title-color font-sm">
                        <i class="ri-bill-line icli"></i>
                        <span>أسئلة متكررة </span>
                    </a>
                    <a href="{{ route('faq') }}" class="arrow"><i data-feather="chevron-right"></i></a>
                </li> --}}
                <li>
                    <a href="{{ route('contactus') }}" class="nav-link title-color font-sm">
                        <i class="ri-bill-line icli"></i>
                        <span>اتصل بنا </span>
                    </a>
                    <a href="{{ route('contactus') }}" class="arrow"><i data-feather="chevron-right"></i></a>
                </li>




            </ul>

            <p class="text-center small text-gray">رقم الإصدار: 1.01</p>


            <div class="row justify-content-center">
                <div class="col-2 text-center">
                    <a target="_blank" href="https://twitter.com/qatrah_khair" class="font-social twitter">
                        <i class="ri-twitter-line"></i>
                    </a>
                </div>
                <div class="col-2 text-center ">
                    <a target="_blank" href="https://www.facebook.com/qatrah_khair" class="font-social facebook">
                        <i class="ri-facebook-circle-line icli"></i>
                    </a>
                </div>
                <div class="col-2 text-center">
                    <a target="_blank" href="https://www.snapchat.com/add/qatrah_khair" class="font-social snapchat">
                        <i class="ri-snapchat-line"></i>
                    </a>
                </div>
                <div class="col-2 text-center">
                    <a target="_blank" href="https://www.instagram.com/qatrah_khair/" class="font-social instagram">
                        <i class="ri-instagram-line"></i>
                    </a>
                </div>
            </div>
            <!-- Navigation End -->

        </div>
    </main>
@endsection
@section('js')
@endsection
