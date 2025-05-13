@extends('layouts.app')
@section('title')
تتبع طلب
@endsection
@section('css')
    <link rel="stylesheet" href="{{ url('') }}/assets/css/lightgallery.min.css">
    <style>
        .bk_gallery {
            display: block;
            text-decoration: none
        }

        .bk_gallery .main_img {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .bk_gallery .main_img img {
            width: 100%;
            border-radius: 8px;
            height: 175px;
            object-fit: cover;
            -webkit-transition: .3s cubic-bezier(.65, .05, .36, 1);
            -moz-transition: .3s cubic-bezier(.65, .05, .36, 1);
            -o-transition: .3s cubic-bezier(.65, .05, .36, 1);
            -ms-transition: .3s cubic-bezier(.65, .05, .36, 1);
            transition: .3s cubic-bezier(.65, .05, .36, 1)
        }

        .bk_gallery .main_img .brfore_1 {
            position: absolute;
            top: -12px;
            z-index: -1;
            opacity: .3;
            width: 100%;
            max-width: 85%
        }

        .bk_gallery .main_img .brfore_2 {
            position: absolute;
            top: -22px;
            z-index: -2;
            opacity: .15;
            width: 100%;
            max-width: 75%
        }

        .bk_gallery:hover .main_img .brfore_1 {
            transform: translateY(-5px);
            opacity: .8
        }

        .bk_gallery:hover .main_img .brfore_2 {
            transform: translateY(-10px);
            opacity: .5
        }

        .bk_gallery .items_gallery {
            display: block
        }

        .bk_gallery .items_gallery a {
            position: relative;
            width: 18.5%;
            border-radius: 5px;
            margin: 5px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            overflow: hidden
        }

        @media(max-width:991px) {
            .bk_gallery .items_gallery a {
                width: 30%
            }
        }

        @media(max-width:767px) {
            .bk_gallery .items_gallery a {
                width: 45%
            }
        }

        .bk_gallery .items_gallery a img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
            transform: scale3d(1, 1, 1);
            -wwbkit-transition: .3s cubic-bezier(.65, .05, .36, 1);
            -moz-transition: .3s cubic-bezier(.65, .05, .36, 1);
            -o-transition: .3s cubic-bezier(.65, .05, .36, 1);
            -ms-transition: .3s cubic-bezier(.65, .05, .36, 1);
            transition: .3s cubic-bezier(.65, .05, .36, 1)
        }

        .bk_gallery .items_gallery a i {
            opacity: 0;
            z-index: 2;
            -wwbkit-transition: .35s all;
            -moz-transition: .35s all;
            -o-transition: .35s all;
            -ms-transition: .35s all;
            transition: .35s all
        }

        .bk_gallery .items_gallery a::before {
            content: "";
            background: transparent;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            -wwbkit-transition: .35s all;
            -moz-transition: .35s all;
            -o-transition: .35s all;
            -ms-transition: .35s all;
            transition: .35s all
        }

        .bk_gallery .items_gallery a:hover img {
            transform: scale3d(1.1, 1.1, 1)
        }

        .bk_gallery .items_gallery a:hover i {
            opacity: 1
        }

        .bk_gallery .items_gallery a:hover::before {
            content: "";
            background: rgba(0, 0, 0, .4)
        }

        .lg-actions .lg-next:before {
            content: "\EA6C";
        }

        .lg-actions .lg-prev:after {
            content: "\EA60";
        }

        .lg-toolbar .lg-close:after {
            content: "\EB99";
        }

        .lg-toolbar .lg-download:after {
            content: "\EC59" !important;
        }

        .lg-toolbar .lg-icon,
        .lg-actions .lg-next,
        .lg-actions .lg-prev {
            font-family: 'remixicon' !important;
            font-style: normal;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            font-weight: 200;
            font-size: 24px;
        }
    </style>
@endsection
@section('skeleton')
@endsection
@section('back_url',route("front.orders.item",$order->id))
@section('content')
    <main class="main-wrap order-tracking-page order-success-page   mb-xxl">

        <!-- Location Section Start -->
        <section class="location-section pt-4">
            <div class="time-box">

                <h1>تتبع الطلب</h1>
            </div>

            <section class="order-id-section">
                <div class="media">
                    <span><i class="ri-calendar-line"></i></span>
                    <div class="media-body">
                        <h2 class="font-sm color-title">تاريخ الطلب</h2>
                        <span
                            class="content-color">{{ \Carbon\Carbon::parse($order->created_at)->translatedFormat('l d M Y') }}</span>
                    </div>
                </div>

                <div class="media">
                    <span><i class="ri-bill-line"></i></span>
                    <div class="media-body">
                        <h2 class="font-sm color-title">رقم الطلب</h2>
                        <span class="content-color">#{{ $order->id }}</span>
                    </div>
                </div>
            </section>


            <ul class="tracking-box">
                <li class="media">
                    <span class="bg-theme-theme"><i class="ri-bill-line icli"></i></span>
                    <div class="media-body">
                        <h3 class="font-sm title-color fw-600">تم إنشاء الطلب</h3>
                        <span class="font-sm content-color">{{ \Carbon\Carbon::parse($order->created_at)->translatedFormat('l d M Y h:i A') }}</span>
                    </div>
                </li>
                @if(!is_null($order->assigned_at))
                <li class="media">
                    <span class="bg-theme-theme"><i class="ri-exchange-funds-fill icli"></i></span>
                    <div class="media-body">
                        <h3 class="font-sm title-color fw-600">تم البدء بتجهيز طلبك</h3>
                        <span class="font-sm content-color">{{ \Carbon\Carbon::parse($order->assigned_at)->translatedFormat('l d M Y h:i A') }}</span>
                    </div>
                </li>
                @endif
                @if(!is_null($order->delivering_at))
                <li class="media">
                    <span class="bg-theme-theme"><i class="ri-truck-line"></i></span>
                    <div class="media-body">
                        <h3 class="font-sm title-color fw-600">طلبك في الطريق مع المندوب</h3>
                        <span class="font-sm content-color">{{ \Carbon\Carbon::parse($order->created_at)->translatedFormat('l d M Y h:i A') }}</span>
                    </div>
                </li>
                @endif
                @if(!is_null($order->delivered_at))
                <li class="media">
                    <span class="bg-theme-theme"><i class="iconly-Location icli"></i></span>
                    <div class="media-body">
                        <h3 class="font-sm title-color fw-600">تم توصيل طلبك بنجاح</h3>
                        <span class="font-sm content-color">{{ \Carbon\Carbon::parse($order->delivered_at)->translatedFormat('l d M Y h:i A') }}</span>
                    </div>
                </li>
                @endif


            </ul>

            <div class="row justify-content-center text-center bk_gallery">
                @if($order->images->count()>0)
                <div class="col-12">
                    <h3 class="mt-5 mb-0">التوثيق المصور</h3>
                    <br class=" mb-3">
                </div>
                <div class="col-12">
                    <div id="aniimated-thumbnials" class="items_gallery">
                        @foreach ($order->images as $img )
                        <a href="{{ url('storage/'.$img->img) }}" data-sub-html='{{ \Carbon\Carbon::parse($img->created_at)->translatedFormat('l d M Y h:i A') }}'>
                            <img src="{{ url('storage/'.$img->img) }}" />
                            <i class="tio-visible_outlined absolute size-22 color-white"></i>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
                @if($order->messages->count()>0)
                <div class="col-12">
                    <h3 class="mt-5 mb-0">الرسائل</h3>
                    <br class=" mb-3">
                </div>
                @foreach ($order->messages as $message )
                <div class="col-12">
                    <p class="border rounded bg-light p-3 small text-start">
                        {{ $message->message }}
                        <br>
                        {{ \Carbon\Carbon::parse($message->created_at)->translatedFormat('l d M Y h:i A') }}
                    </p>
                </div>
                @endforeach
                @endif
            </div>
        </section>
        <!-- Location Section End -->


    </main>
@endsection
@section('js')
    <script src="{{ url('') }}/assets/js/lightgallery.min.js"></script>
    <script>
        lightGallery(document.getElementById('aniimated-thumbnials'), {
            thumbnail: true,
            // mode: 'lg-tube',
        });
    </script>
@endsection
