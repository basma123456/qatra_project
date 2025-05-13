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
@section('back_url', route('front.orders'))
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
                <p class="font-sm content-color">رقم الطلب الخاص بك هو #{{ $order->id }}</p>
            </div>
        </section>
        <!-- Banner Section End -->

        <!-- Order Id Section Start -->
        <section class="order-id-section">
            <div class="media">
                <span><i class="ri-calendar-line"></i></span>
                <div class="media-body">
                    <h2 class="font-sm color-title">تاريخ الطلب</h2>
                    <span
                        class="content-color">{{ \Carbon\Carbon::parse($order->created_at)->translatedFormat('d M Y') }}</span>
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
                        {{-- <span>{{ $detail->title }}</span>
                    <span>{{ number_format($detail->price * $detail->quantity,2) }}</span> --}}
                        <span>{{ $detail->quantity }} × {{ $detail->title }} × {{ $detail->price }} ريال
                        </span>
                        <span>{{ number_format($detail->quantity * $detail->price, 2) }}</span>
                    </li>
                @endforeach

                {{-- <li>
                    <span>رسوم التوصيل</span>
                    <span>25.00</span>
                </li> --}}

                <li>
                    <span>المجموع غير شامل الضريبة</span>
                    <span>{{ number_format($order->total - $order->tax, 2) }}</span>
                </li>
                <li>
                    <span>الضريبة {{ env('SAUDI_TAX') }}% </span>
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
            <p> {{ $order->delivery_type->name }}
                @if ($order->delivery_type_id > 1)
                    ( {{ $order->delivery_name }} - {{ $order->delivery_mobile }} )
                @endif
            </p>
            <!-- Product Detail  End -->
        </section>
        <div class="pb-5">
            <section class="order-detail mt-3 pb-5">
                <h3 class="title-2">طريقة الدفع</h3>
                <ul>
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

                    <li>

                    </li>

                </ul>
            </section>
        </div>

        {{-- <div class="row mt-3">
            <div class="col-6 text-center">

                <a href="#" class="title-color font-sm fw-600"><i class="ri-file-pdf-line"></i>
                    تحميل الفاتورة</a>

            </div>
            <div class="col-6 text-center">
                <a href="{{ route('front.orders.track',$order->id) }}" class="title-color font-sm fw-600"><i class="ri-road-map-line"></i> تتبع
                    الطلب</a>
            </div>
        </div> --}}
        <div class="my-3 py-3"></div>
        <!-- Order Detail End -->
    </main>
@endsection
@section('js')
    <script>
        gtag('event', 'purchase', {
            'currency': 'SAR',
            'transaction_id': '{{ $order->id }}',
            'value': {{ number_format($order->total, 2) }},
            items: [
                @foreach ($order->details as $item)
                    {
                        item_name: "{{ $item->title }}",
                        index: {{ $loop->index }},
                        price: {{ $item->price }},
                        quantity: {{ $item->quantity }}
                    }
                    @if (!$loop->last)
                        ,
                    @endif
                @endforeach
            ]
        });
        snaptr('track', 'PURCHASE', {
            'currency': 'SAR',
            'price': '{{ number_format($order->total, 2) }}',
            'transaction_id': '{{ $order->id }}'
        });
        fbq('track', 'Purchase', {
            content_ids: "{{ $order->id }}",
            currency: "SAR",
            value: "{{ number_format($order->total, 2) }}"
        });
    </script>
    <!-- Event snippet for pursh conversion page -->
    <script>
        gtag('event', 'conversion', {
            'send_to': 'AW-11084470637/9v28CIezq4oYEO2yvqUp',
            'transaction_id': '{{ $order->id }}'
        });
    </script>
    <script type="text/javascript">
        // Insert Twitter Event ID
        twq('event', 'tw-oi6qe-ok7n4', {
            value: "{{ number_format($order->total, 2) }}", // use this to pass the value of the conversion (e.g. 5.00)
            currency: "SAR" // use this to pass the currency of the conversion with an ISO 4217 code (e.g. ‘USD’)
        });
    </script>
    <!-- End Twitter conversion tracking event code -->
@endsection
