@extends('layouts.app')
@section('title')
استعراض طلب
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
@section('back_url',route("front.orders"))
@section('content')
    <main class="main-wrap order-success-page mb-xxl">

        <!-- Banner Section Start -->

        <!-- Banner Section End -->

        <!-- Order Id Section Start -->
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
        <!-- Order Id Section End -->

        <!-- Order Detail Start -->
        <section class="order-detail">
            <h3 class="title-2">تفاصيل الطلب</h3>
            <!-- Product Detail  Start -->
            <ul>
                @foreach ($order->details as $detail)
                <li>
                    <span>{{ $detail->quantity }} × {{ $detail->title }} × {{ $detail->price }} ريال</span>
                    <span>{{ number_format($detail->price * $detail->quantity, 2) }}</span>
                </li>
                @endforeach
                <li>
                    <span>المجموع غير شامل الضريبة</span>
                    <span>{{ number_format($order->total -$order->tax ,2) }}</span>
                </li>
                <li>
                    <span>الضريبة {{ number_format(($order->tax / ($order->total - $order->tax)) * 100) }}% </span>
                    <span>{{ number_format($order->tax, 2) }}</span>
                </li>
                <li>
                    <span>الإجمالي</span>
                    <span>{{ number_format($order->total, 2) }}</span>
                </li>
            </ul>
            <!-- Product Detail  End -->
        </section>
        <section class="order-detail mt-3">
            <h3 class="title-2">التسليم</h3>
            <!-- Product Detail  Start -->
            <p>{{ $order->mosque->city->name }},{{ $order->mosque->district->name }} - {{ $order->mosque->name }} </p>
            <p>
                {{-- {{ $order->delivery_type->name }} --}}
                @if ($order->delivery_type_id > 1)
                    ( {{ $order->delivery_name }} - {{ $order->delivery_mobile }} )
                @endif
            </p>
            <!-- Product Detail  End -->
        </section>
        <section class="order-detail mt-3">
            <h3 class="title-2">طريقة الدفع</h3>
            <ul>
                @if ($order->payment_type_id == 1)
                    <li >
                        <span>تم الدفع باستخدام</span>
                        <span>{{ $order->payment->brand }}</span>
                    </li>

                    <li>
                        <span>رقم البطاقة</span>
                        <span>{{ substr($order->payment->last4, -4) }}</span>
                    </li>
                    <li>
                        <span>مرجع</span>
                        <span>{{ $order->payment->transaction_id }}</span>
                    </li>
                    <li>
                        <span>الحالة</span>
                        <span>{{ $order->order_status->name }}</span>
                    </li>
                @else
                    <li>
                        <span>تم الدفع باستخدام</span>
                        <span>حوالة بنكية</span>
                    </li>

                    <li>
                        <span>اسم البنك</span>
                        <span>{{ $order->transfer->bank->name }}</span>
                    </li>

                    <li>
                        <span>الحالة</span>
                        <span>{{ $order->order_status->name }}</span>
                    </li>
                @endif

            </ul>
        </section>

        <div class="row mt-3">
            <div class="col-6 text-center">

                {{-- <a href="{{ route('front.orders.pdf', $order->id) }}" class="title-color font-sm fw-600"><i
                        class="ri-file-pdf-line"></i>
                    تحميل الفاتورة</a> --}}

            </div>
            <div class="col-6 text-center">
                <a href="{{ route('front.orders.track', $order->id) }}" class="title-color font-sm fw-600"><i
                        class="ri-road-map-line"></i> تتبع
                    الطلب</a>
            </div>
        </div>
        <div class="my-3 py-3"></div>
        <!-- Order Detail End -->
    </main>
@endsection
@section('js')
@endsection
