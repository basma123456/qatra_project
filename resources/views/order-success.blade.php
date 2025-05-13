@extends('layouts.app')
@section('title')
@endsection
@section('css')
    <style>
        .success_flag {
            color: #4DAF36;
            font-size: 100px;
        }
    </style>
@endsection
@section('skeleton')
@endsection
@section('content')
    <main class="main-wrap order-success-page mb-xxl">
        <div class="steps">
            <ul>
                <li class="selected">
                    <span class=""><i class="ri-check-line"></i></span>
                    <strong class="">المسجد</strong>
                </li>
                <li class="selected">
                    <span><i class="ri-check-line"></i></span>
                    <strong>الكمية</strong>
                </li>
                <li class="selected"><span><i class="ri-check-line"></i></span>
                    <strong>الدفع</strong>
                </li>
                <li class="selected"><span>4</span>
                    <strong>التأكيد</strong>
                </li>
            </ul>
        </div>
        <!-- Banner Section Start -->
        <section class="banner-section">
            
         

            <div class="banner-wrap">
                <i class="ri-checkbox-circle-line success_flag"></i>
            </div>

            <div class="content-wrap">
                <h1 class="font-lg title-color">شكراً تم طلبك بنجاح!</h1>
                <p class="font-sm content-color">رقم الطلب الخاص بك هو #548475151</p>
            </div>
        </section>
        <!-- Banner Section End -->

        <!-- Order Id Section Start -->
        <section class="order-id-section">
            <div class="media">
                <span><i class="ri-calendar-line"></i></span>
                <div class="media-body">
                    <h2 class="font-sm color-title">تاريخ الطلب</h2>
                    <span class="content-color">الأحد, 14 إبريل 2022 , 19:12</span>
                </div>
            </div>

            <div class="media">
                <span><i class="ri-bill-line"></i></span>
                <div class="media-body">
                    <h2 class="font-sm color-title">رقم الطلب</h2>
                    <span class="content-color">#548475151</span>
                </div>
            </div>
        </section>
        <!-- Order Id Section End -->

        <!-- Order Detail Start -->
        <section class="order-detail">
            <h3 class="title-2">تفاصيل الطلب</h3>
            <!-- Product Detail  Start -->
            <ul>
                <li>
                    <span>20 كرتون ماء</span>
                    <span>340.00</span>
                </li>

                <li>
                    <span>رسوم التوصيل</span>
                    <span>25.00</span>
                </li>

                <li>
                    <span>الضريبة 15% </span>
                    <span>54.75</span>
                </li>
                <li>
                    <span>الإجمالي</span>
                    <span>419.75</span>
                </li>
            </ul>
            <!-- Product Detail  End -->
        </section>
        <section class="order-detail mt-3">
            <h3 class="title-2">التسليم</h3>
            <!-- Product Detail  Start -->
            <p>مكة - مسجد الخير </p>
            <p> التسليم لشخص معين (محمد الغامدي - 0543284938)</p>
            <!-- Product Detail  End -->
        </section>
        <section class="order-detail mt-3">
            <h3 class="title-2">طريقة الدفع</h3>
            <ul>
                <li>
                    <span>تم الدفع باستخدام</span>
                    <span>Visa</span>
                </li>

                <li>
                    <span>رقم البطاقة</span>
                    <span>8934</span>
                </li>
                <li>
                    <span>رقم الموافقة</span>
                    <span>98945222</span>
                </li>
                <li>
                    
                </li>

            </ul>
        </section>

        <div class="row mt-3">
            <div class="col-6 text-center">
                
                    <a href="{{ route("order-success") }}" class="title-color font-sm fw-600"><i class="ri-file-pdf-line"></i> تحميل الفاتورة</a>
                
            </div>
            <div class="col-6 text-center">
                <a href="{{ route("tracking") }}" class="title-color font-sm fw-600"><i class="ri-road-map-line"></i> تتبع الطلب</a>
            </div>
        </div>
        <div class="my-3 py-3"></div>
        <!-- Order Detail End -->
    </main>
@endsection
@section('js')
@endsection
