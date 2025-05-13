@extends('layouts.app')
@section('title')
    اختر طريقة الدفع
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdn.moyasar.com/mpf/1.6.1/moyasar.css">
    <style>
        .account_box {
            border: 1px solid #a5e3fb;
            background-color: #e9f9ff;
            border-radius: 12px;
            padding: 10px;
            width: 100%;
            margin: 0;
        }

        .drop_box {
            margin: 10px 0;
            padding: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            border: 3px dotted #a3a3a3;
            border-radius: 5px;
            width: 100%;
        }

        .drop_box h4 {
            font-size: 16px;
            font-weight: 400;
            color: #2e2e2e;
        }

        .drop_box p {
            margin-top: 10px;
            margin-bottom: 20px;
            font-size: 12px;
            color: #a3a3a3;
        }

        .form-row {
            width: 70%;
            float: left;
            background-color: #ededed;
        }

        #card-element {
            background-color: transparent;
            height: 40px;
            border-radius: 4px;
            border: 1px solid transparent;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }

        #card-element--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        #card-element--invalid {
            border-color: #fa755a;
        }

        #card-element--webkit-autofill {
            background-color: #fefde5 !important;
        }

        #submitbutton,
        #tap-btn {
            align-items: flex-start;
            background-attachment: scroll;
            background-clip: border-box;
            background-color: rgb(50, 50, 93);
            background-image: none;
            background-origin: padding-box;
            background-position-x: 0%;
            background-position-y: 0%;
            background-size: auto;
            border-bottom-color: rgb(255, 255, 255);
            border-bottom-left-radius: 4px;
            border-bottom-right-radius: 4px;
            border-bottom-style: none;
            border-bottom-width: 0px;
            border-image-outset: 0px;
            border-image-repeat: stretch;
            border-image-slice: 100%;
            border-image-source: none;
            border-image-width: 1;
            border-left-color: rgb(255, 255, 255);
            border-left-style: none;
            border-left-width: 0px;
            border-right-color: rgb(255, 255, 255);
            border-right-style: none;
            border-right-width: 0px;
            border-top-color: rgb(255, 255, 255);
            border-top-left-radius: 4px;
            border-top-right-radius: 4px;
            border-top-style: none;
            border-top-width: 0px;
            box-shadow: rgba(50, 50, 93, 0.11) 0px 4px 6px 0px, rgba(0, 0, 0, 0.08) 0px 1px 3px 0px;
            box-sizing: border-box;
            color: rgb(255, 255, 255);
            cursor: pointer;
            display: block;
            float: left;
            font-family: "Helvetica Neue", Helvetica, sans-serif;
            font-size: 15px;
            font-stretch: 100%;
            font-style: normal;
            font-variant-caps: normal;
            font-variant-east-asian: normal;
            font-variant-ligatures: normal;
            font-variant-numeric: normal;
            font-weight: 600;
            height: 35px;
            letter-spacing: 0.375px;
            line-height: 35px;
            margin-bottom: 0px;
            margin-left: 12px;
            margin-right: 0px;
            margin-top: 28px;
            outline-color: rgb(255, 255, 255);
            outline-style: none;
            outline-width: 0px;
            overflow-x: visible;
            overflow-y: visible;
            padding-bottom: 0px;
            padding-left: 14px;
            padding-right: 14px;
            padding-top: 0px;
            text-align: center;
            text-decoration-color: rgb(255, 255, 255);
            text-decoration-line: none;
            text-decoration-style: solid;
            text-indent: 0px;
            text-rendering: auto;
            text-shadow: none;
            text-size-adjust: 100%;
            text-transform: none;
            transition-delay: 0s;
            transition-duration: 0.15s;
            transition-property: all;
            transition-timing-function: ease;
            white-space: nowrap;
            width: 150.781px;
            word-spacing: 0px;
            writing-mode: horizontal-tb;
            -webkit-appearance: none;
            -webkit-font-smoothing: antialiased;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            -webkit-border-image: none;

        }
        .payment-page .order-detail ul li:last-child{
            font-weight:normal;
        }
    </style>
@endsection
@section('back_url', route('front.products', $order->mosque_id))
@section('content')
    <main class="main-wrap payment-page mb-xxl">
        <section class="order-detail">
            <h3 class="title-2">مكان التوصيل</h3>
            <!-- Product Detail  Start -->
            <ul>
                <li>
                    <span>{{ $order->mosque->name }} - {{ $order->mosque->city->name }}</span>
                </li>
            </ul>
            <!-- Product Detail  End -->
        </section>
        <section class="order-detail mt-3">
            <h3 class="title-2">تفاصيل الطلب</h3>
            <!-- Product Detail  Start -->
            <ul>
                @foreach ($order->details as $item)
                    <li>
                        <span>{{ $item->quantity }} × {{ $item->title }} × {{ $item->price }} ريال
                        </span>
                        <span>{{ number_format($item->price * $item->quantity, 2) }}</span>
                    </li>
                @endforeach
            </ul>
        </section>
        <section class="payment-section py-0">
            @include('front.messages')
            {{-- @if (!$safari && $iphone) 
            <div class="alert alert-warning">للدفع بـ  Apple Pay  يجب استخدام متصفح سفاري</div>
            @endif --}}
            <!-- Payment Method Accordian Start -->
            <div id="waitingdiv" class="p-5 text-center" style="display: none">
                <div class="spinner-border m-5 " role="status"><span class=" visually-hidden">Loading...</span></div>
                <h3 class="my-2">تم طلبكم بنجاح </h3>
                <p class="my-2">جاري إعداد بيانات الطلب</p>
            </div>
            <div class="accordion" id="accordionExample">
                <!-- Accordion Start -->
                {{-- "iphone","safari" --}}
                @if ($safari)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingiphone">
                            <button class="accordion-button font-md title-color" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseiphone" aria-expanded="true" aria-controls="collapseiphone">

                                <svg style="width: 40px; height: 40px;margin-left: 10px;" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 32 32">
                                    <path
                                        d="M 5 6 C 3.355 6 2 7.355 2 9 L 2 23 C 2 24.645 3.355 26 5 26 L 27 26 C 28.645 26 30 24.645 30 23 L 30 9 C 30 7.355 28.645 6 27 6 L 5 6 z M 5 8 L 27 8 C 27.566 8 28 8.434 28 9 L 28 23 C 28 23.566 27.566 24 27 24 L 5 24 C 4.434 24 4 23.566 4 23 L 4 9 C 4 8.434 4.434 8 5 8 z M 10.998047 11 C 10.533047 11 10.002203 11.265344 9.6582031 11.652344 C 9.3922031 11.973344 9.103125 12.483187 9.203125 12.992188 C 9.680125 13.048187 10.201 12.749328 10.5 12.361328 C 10.832 12.007328 11.020047 11.509 10.998047 11 z M 13 13 L 13 19 L 13.931641 19 L 13.931641 16.945312 L 15.228516 16.945312 C 16.403516 16.945312 17.234375 16.136656 17.234375 14.972656 C 17.234375 13.797656 16.414 13 15.25 13 L 13 13 z M 7.8378906 13.523438 C 6.7988906 13.523438 6 14.433281 6 15.738281 C 6 17.438281 7.1944531 19 7.9394531 19 C 8.3894531 19 8.5543437 18.697266 9.1523438 18.697266 C 9.7033437 18.697266 9.8767031 19 10.345703 19 C 11.236703 19 11.972 17.190078 12 17.080078 C 11.853 17.006078 10.997047 16.602906 10.998047 15.628906 C 10.998047 14.682906 11.779406 14.258234 11.816406 14.240234 C 11.384406 13.597234 10.704266 13.523438 10.447266 13.523438 C 9.8502656 13.523438 9.3279688 13.845703 9.0429688 13.845703 C 8.7489688 13.845703 8.3158906 13.523438 7.8378906 13.523438 z M 13.931641 13.787109 L 15.005859 13.787109 C 15.814859 13.787109 16.28125 14.218656 16.28125 14.972656 C 16.28125 15.726656 15.814859 16.169922 15.005859 16.169922 L 13.931641 16.169922 L 13.931641 13.787109 z M 19.429688 14.53125 C 18.443687 14.53125 17.711453 15.097047 17.689453 15.873047 L 18.53125 15.873047 C 18.59825 15.507047 18.94025 15.263672 19.40625 15.263672 C 19.98225 15.263672 20.294922 15.529578 20.294922 16.017578 L 20.294922 16.349609 L 19.130859 16.427734 C 18.055859 16.494734 17.466797 16.938125 17.466797 17.703125 C 17.466797 18.479125 18.065688 19 18.929688 19 C 19.516687 19 20.061688 18.700375 20.304688 18.234375 L 20.326172 18.234375 L 20.326172 18.955078 L 21.191406 18.955078 L 21.191406 15.962891 C 21.191406 15.097891 20.493688 14.53125 19.429688 14.53125 z M 21.574219 14.587891 L 23.148438 18.966797 L 23.070312 19.232422 C 22.926313 19.676422 22.693203 19.853516 22.283203 19.853516 C 22.206203 19.853516 22.062812 19.841797 22.007812 19.841797 L 22.007812 20.5625 C 22.063813 20.5735 22.294328 20.583984 22.361328 20.583984 C 23.270328 20.583984 23.703078 20.2295 24.080078 19.1875 L 25.708984 14.587891 L 24.765625 14.587891 L 23.669922 18.134766 L 23.646484 18.134766 L 22.550781 14.587891 L 21.574219 14.587891 z M 20.294922 16.980469 L 20.294922 17.314453 L 20.292969 17.314453 C 20.292969 17.879453 19.816547 18.277344 19.185547 18.277344 C 18.686547 18.277344 18.376953 18.045688 18.376953 17.679688 C 18.376953 17.302688 18.675672 17.079875 19.263672 17.046875 L 20.294922 16.980469 z" />
                                </svg>
                                Apple Pay
                            </button>
                        </h2>
                        <div id="collapseiphone" class="accordion-collapse collapse show" aria-labelledby="headingiphone"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <a href="{{ route('front.payment.applepay', $order->id) }}" class="btn btn-outline">
                                    <svg style="width: 40px; height: 40px;margin-left: 10px;"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 640 512"><!-- Font Awesome Free 5.15.3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) -->
                                        <path
                                            d="M116.9 158.5c-7.5 8.9-19.5 15.9-31.5 14.9-1.5-12 4.4-24.8 11.3-32.6 7.5-9.1 20.6-15.6 31.3-16.1 1.2 12.4-3.7 24.7-11.1 33.8m10.9 17.2c-17.4-1-32.3 9.9-40.5 9.9-8.4 0-21-9.4-34.8-9.1-17.9.3-34.5 10.4-43.6 26.5-18.8 32.3-4.9 80 13.3 106.3 8.9 13 19.5 27.3 33.5 26.8 13.3-.5 18.5-8.6 34.5-8.6 16.1 0 20.8 8.6 34.8 8.4 14.5-.3 23.6-13 32.5-26 10.1-14.8 14.3-29.1 14.5-29.9-.3-.3-28-10.9-28.3-42.9-.3-26.8 21.9-39.5 22.9-40.3-12.5-18.6-32-20.6-38.8-21.1m100.4-36.2v194.9h30.3v-66.6h41.9c38.3 0 65.1-26.3 65.1-64.3s-26.4-64-64.1-64h-73.2zm30.3 25.5h34.9c26.3 0 41.3 14 41.3 38.6s-15 38.8-41.4 38.8h-34.8V165zm162.2 170.9c19 0 36.6-9.6 44.6-24.9h.6v23.4h28v-97c0-28.1-22.5-46.3-57.1-46.3-32.1 0-55.9 18.4-56.8 43.6h27.3c2.3-12 13.4-19.9 28.6-19.9 18.5 0 28.9 8.6 28.9 24.5v10.8l-37.8 2.3c-35.1 2.1-54.1 16.5-54.1 41.5.1 25.2 19.7 42 47.8 42zm8.2-23.1c-16.1 0-26.4-7.8-26.4-19.6 0-12.3 9.9-19.4 28.8-20.5l33.6-2.1v11c0 18.2-15.5 31.2-36 31.2zm102.5 74.6c29.5 0 43.4-11.3 55.5-45.4L640 193h-30.8l-35.6 115.1h-.6L537.4 193h-31.6L557 334.9l-2.8 8.6c-4.6 14.6-12.1 20.3-25.5 20.3-2.4 0-7-.3-8.9-.5v23.4c1.8.4 9.3.7 11.6.7z" />
                                    </svg>
                                    ادفع الآن
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
                @if ($iphone && !$safari)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingiphone">
                            <button class="accordion-button font-md title-color" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseiphone" aria-expanded="true" aria-controls="collapseiphone">

                                <svg style="width: 40px; height: 40px;margin-left: 10px;" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 32 32">
                                    <path
                                        d="M 5 6 C 3.355 6 2 7.355 2 9 L 2 23 C 2 24.645 3.355 26 5 26 L 27 26 C 28.645 26 30 24.645 30 23 L 30 9 C 30 7.355 28.645 6 27 6 L 5 6 z M 5 8 L 27 8 C 27.566 8 28 8.434 28 9 L 28 23 C 28 23.566 27.566 24 27 24 L 5 24 C 4.434 24 4 23.566 4 23 L 4 9 C 4 8.434 4.434 8 5 8 z M 10.998047 11 C 10.533047 11 10.002203 11.265344 9.6582031 11.652344 C 9.3922031 11.973344 9.103125 12.483187 9.203125 12.992188 C 9.680125 13.048187 10.201 12.749328 10.5 12.361328 C 10.832 12.007328 11.020047 11.509 10.998047 11 z M 13 13 L 13 19 L 13.931641 19 L 13.931641 16.945312 L 15.228516 16.945312 C 16.403516 16.945312 17.234375 16.136656 17.234375 14.972656 C 17.234375 13.797656 16.414 13 15.25 13 L 13 13 z M 7.8378906 13.523438 C 6.7988906 13.523438 6 14.433281 6 15.738281 C 6 17.438281 7.1944531 19 7.9394531 19 C 8.3894531 19 8.5543437 18.697266 9.1523438 18.697266 C 9.7033437 18.697266 9.8767031 19 10.345703 19 C 11.236703 19 11.972 17.190078 12 17.080078 C 11.853 17.006078 10.997047 16.602906 10.998047 15.628906 C 10.998047 14.682906 11.779406 14.258234 11.816406 14.240234 C 11.384406 13.597234 10.704266 13.523438 10.447266 13.523438 C 9.8502656 13.523438 9.3279688 13.845703 9.0429688 13.845703 C 8.7489688 13.845703 8.3158906 13.523438 7.8378906 13.523438 z M 13.931641 13.787109 L 15.005859 13.787109 C 15.814859 13.787109 16.28125 14.218656 16.28125 14.972656 C 16.28125 15.726656 15.814859 16.169922 15.005859 16.169922 L 13.931641 16.169922 L 13.931641 13.787109 z M 19.429688 14.53125 C 18.443687 14.53125 17.711453 15.097047 17.689453 15.873047 L 18.53125 15.873047 C 18.59825 15.507047 18.94025 15.263672 19.40625 15.263672 C 19.98225 15.263672 20.294922 15.529578 20.294922 16.017578 L 20.294922 16.349609 L 19.130859 16.427734 C 18.055859 16.494734 17.466797 16.938125 17.466797 17.703125 C 17.466797 18.479125 18.065688 19 18.929688 19 C 19.516687 19 20.061688 18.700375 20.304688 18.234375 L 20.326172 18.234375 L 20.326172 18.955078 L 21.191406 18.955078 L 21.191406 15.962891 C 21.191406 15.097891 20.493688 14.53125 19.429688 14.53125 z M 21.574219 14.587891 L 23.148438 18.966797 L 23.070312 19.232422 C 22.926313 19.676422 22.693203 19.853516 22.283203 19.853516 C 22.206203 19.853516 22.062812 19.841797 22.007812 19.841797 L 22.007812 20.5625 C 22.063813 20.5735 22.294328 20.583984 22.361328 20.583984 C 23.270328 20.583984 23.703078 20.2295 24.080078 19.1875 L 25.708984 14.587891 L 24.765625 14.587891 L 23.669922 18.134766 L 23.646484 18.134766 L 22.550781 14.587891 L 21.574219 14.587891 z M 20.294922 16.980469 L 20.294922 17.314453 L 20.292969 17.314453 C 20.292969 17.879453 19.816547 18.277344 19.185547 18.277344 C 18.686547 18.277344 18.376953 18.045688 18.376953 17.679688 C 18.376953 17.302688 18.675672 17.079875 19.263672 17.046875 L 20.294922 16.980469 z" />
                                </svg>
                                Apple Pay
                            </button>
                        </h2>
                        <div id="collapseiphone" class="accordion-collapse collapse show" aria-labelledby="headingiphone"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p class="text-danger"><i class="ri-information-line"></i> تنويه: للدفع بواسطة أبل باي يجب
                                    عليك استخدام متصفح سفاري فقط
                                </p>
                                <p class="text-secondary">في حال دخولك لهذه الصفحة من خلال سناب شات أو أي تطبيق آخر، يمكنك
                                    الضغط على الثلاث نقاط أعلى الصفحة والدخول على متصفح سفاري (إن لم تكن تستخدمه) وذلك
                                    لإتمام الدفع.
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button
                            class="accordion-button font-md title-color @if (!$safari) collapsed @endif"
                            type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false"
                            aria-controls="collapseOne">
                            <svg style="width: 40px; height: 35px;margin-left: 10px;" xmlns="http://www.w3.org/2000/svg"
                                width="16" height="16" fill="currentColor" class="bi bi-credit-card"
                                viewBox="0 0 16 16">
                                <path
                                    d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1H2zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V7z" />
                                <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1z" />
                            </svg>
                            بطاقة ائتمانية / مدى
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse  @if (!$safari) show @endif"
                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="offcanvas-body small">
                                <div class="custom-form">

                                    <form id="form-container" method="post"
                                        action="{{ route('front.payment.charge', $order->id) }}">
                                        @csrf
                                        <!-- Tap element will be here -->
                                        <div id="element-container"></div>
                                        <div id="error-handler" role="alert"></div>
                                        <div id="success" style=" display: none;;position: relative;float: left;">
                                            جاري تنفيذ العملية <span id="token"></span>
                                        </div>
                                        <!-- Tap pay button -->
                                        <button id="tap-btn" class="disableafterclickpay">إرسال</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Accordion End -->

                <!-- Accordion Start -->
                {{-- <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button font-md title-color collapsed" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                            aria-controls="collapseTwo">
                            <svg style="width: 40px; height: 40px;margin-left: 10px;" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="mdi-bank-transfer"
                                width="24" height="24" viewBox="0 0 24 24">
                                <path
                                    d="M15,14V11H18V9L22,12.5L18,16V14H15M14,7.7V9H2V7.7L8,4L14,7.7M7,10H9V15H7V10M3,10H5V15H3V10M13,10V12.5L11,14.3V10H13M9.1,16L8.5,16.5L10.2,18H2V16H9.1M17,15V18H14V20L10,16.5L14,13V15H17Z" />
                            </svg>
                            تحويل بنكي
                        </button>
                    </h2>

                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body net-banking">
                            <form action="{{ route('front.payment.transfer', $order->id) }}" id="form_3"
                                method="POST" enctype="multipart/form-data">

                                @csrf
                                <div class="row">
                                    <!-- Net Banking Option Start -->
                                    <div class="col-12">
                                        <p class="mb-3">فضلاً حدد البنك</p>
                                    </div>
                                    <div class="input-box col-12">
                                        <select name="bank_id" class="select-control" style="width: 100%">
                                            @foreach ($banks as $bank)
                                                <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- Net Banking Option End -->

                                    <!-- Net Banking Option Start -->
                                    <div class="input-box col-12">

                                        <div class="drop_box">
                                            <header>
                                                <h4>أرفق صورة إيصال الحوالة</h4>
                                            </header>
                                            <p>الملفات المدعومة: PDF, JPG</p>
                                            <input id="transfer_img" type="file" hidden accept=".jpg,.jpeg,.pdf,.png"
                                                style="display:none;" name="transfer_img" onchange="previewImage(this)"
                                                data-output="formfilepreview" data-button="button_remove_image">
                                            <button id="btn_upload" class="btn">اختر ملف</button>
                                            <img class="border p-1 my-1 w-100 rounded" src=""
                                                id="formfilepreview" style="display: none" />
                                        </div>


                                    </div>
                                    <!-- Net Banking Option End -->
                                    @foreach ($banks as $bank)
                                        <div class="col-12 mb-3">
                                            <div class="row account_box">
                                                <div class="col-12 mb-3">
                                                    <h3>{{ $bank->name }}</h3>
                                                </div>
                                                <div class="col-12 mb-1">
                                                    المستفيد: {{ $bank->account_name }}
                                                </div>
                                                <div class="col-12 mb-1">
                                                    <div class="row">
                                                        <div class="col-10" style="width:unset">رقم الحساب:
                                                            {{ $bank->account_no }}</div>
                                                        <div class="col-2" style="width:unset">
                                                            <button type="button" class="btn"><i
                                                                    onclick="copyToClipboard('{{ $bank->account_no }}')"
                                                                    class="ri-file-copy-2-line"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 mb-1">
                                                    <div class="row">
                                                        <div class="col-10" style="width:unset">رقم الآيبان:
                                                            {{ $bank->iban }}
                                                        </div>
                                                        <div class="col-2" style="width:unset">
                                                            <button type="button" class="btn"><i
                                                                    onclick="copyToClipboard('{{ $bank->iban }}')"
                                                                    class="ri-file-copy-2-line"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <footer class="footer-wrap footer-button">
                                    <button type="button" id="submit_form" class="font-md w-100"><span
                                            class="text-white">تأكيد
                                        </span></a>
                                </footer>
                            </form>


                        </div>
                    </div>
                </div> --}}
                <!-- Accordion End -->


            </div>
            <!-- Payment Method Accordian End -->
        </section>
    </main>
    <div class="offcanvas offcanvas-bottom addtohome-popup notification-popup" tabindex="-1" id="notification-popup">
        <div class="offcanvas-body small">
            <div class="app-info">
                <div class="content">
                    <h3>تنبيه <i data-feather="x" data-bs-dismiss="offcanvas"></i></h3>
                </div>
            </div>
            <p class="my-2" id="notification-text"></p>
            <button class="btn-solid install-app" data-bs-dismiss="offcanvas">إغلاق</button>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $("#layout_footer").hide();
        $('#btn_upload').click(function() {
            $('#transfer_img').click();
            return false;
        });
        $('#submit_form').click(function() {
            // alert("submit_form");
            var flag = true;
            var msg = "";
            if ($('#transfer_img').get(0).files.length === 0) {
                msg = "يجب ارفاق صورة إيصال الحوالة";
                flag = false;
            }



            if (flag) {
                $("#accordionExample").hide();
                $("#waitingdiv").show();
                $("#form_3").submit();
            } else {
                $("#notification-text").html(msg);
                var myOffcanvas = document.getElementById('notification-popup')
                var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas)
                bsOffcanvas.show()
            }

        });

        function copyToClipboard(text) {
            var sampleTextarea = document.createElement("textarea");
            document.body.appendChild(sampleTextarea);
            sampleTextarea.value = text; //save main text in it
            sampleTextarea.select(); //select textarea contenrs
            document.execCommand("copy");
            document.body.removeChild(sampleTextarea);
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bluebird/3.3.4/bluebird.min.js"></script>
    <script src="https://secure.gosell.io/js/sdk/tap.min.js"></script>
    <script>
        //pass your public key from tap's dashboard
        var tap = Tapjsli('{{ $Publishable_API_Key }}');

        var elements = tap.elements({});
        var style = {
            base: {
                color: '#535353',
                lineHeight: '18px',
                fontFamily: 'SSTArabic',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: 'rgba(0, 0, 0, 0.26)',
                    fontSize: '15px'
                }
            },
            invalid: {
                color: 'red'
            }
        };
        // input labels/placeholders
        var labels = {
            cardNumber: "{{ __('Card Number') }}",
            expirationDate: "MM/YY",
            cvv: "CVV",
            cardHolder: "{{ __('Card Holder Name') }}"
        };
        //payment options
        var paymentOptions = {
            currencyCode: ["SAR"],
            labels: labels,
            TextDirection: 'rtl'
        }
        //create element, pass style and payment options
        var card = elements.create('card', {
            style: style
        }, paymentOptions);
        //mount element
        card.mount('#element-container');
        //card change event listener
        card.addEventListener('change', function(event) {
            if (event.BIN) {
                console.log(event.BIN)
            }
            if (event.loaded) {
                console.log("UI loaded :" + event.loaded);
                console.log("current currency is :" + card.getCurrency())
            }
            var displayError = document.getElementById('error-handler');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission
        var form = document.getElementById('form-container');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            tap.createToken(card).then(function(result) {
                console.log(result);
                if (result.error) {
                    // Inform the user if there was an error
                    var errorElement = document.getElementById('error-handler');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server
                    var errorElement = document.getElementById('success');
                    errorElement.style.display = "block";
                    // var tokenElement = document.getElementById('token');
                    // tokenElement.textContent = result.id;
                    // console.log(result.id);
                    tapTokenHandler(result)
                }
            });
        });

        function tapTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('form-container');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'tapToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }

        function previewImage(input) {
            var file = $(input).get(0).files[0];
            var output = $(input).data("output");
            var button = $(input).data("button");

            if (file) {
                var reader = new FileReader();
                var extension = input.files[0].name.split('.').pop().toLowerCase();
                // alert(extension);
                if (extension == "pdf") {
                    // redaer.readAsDataURL("{{ url('assets/images/pdf.jpg') }}");
                    $("#" + output).attr('src', "{{ url('assets/images/pdf.jpg') }}");
                    $("#" + output).show();
                    $("#" + button).show();
                } else {
                    reader.onload = function() {
                        $("#" + output).attr('src', reader.result);
                        $("#" + output).show();
                        $("#" + button).show();
                    }
                    reader.readAsDataURL(file);
                }
            }
        }
        $(".button_remove_image").on('click', function() {
            var output = $(this).data("output");
            var image = $(this).data("file");
            // $("#"+image).attr("src",null);
            $("#" + image).val('');
            // $(output).hide();
            // alert("#"+image);
            // alert("output#"+output);
            $("#" + output).hide();
            $(this).hide();
        });
        $('.disableafterclickpay').on('click', function() {
            $("#accordionExample").hide();
            $("#waitingdiv").show();
            // $(this).html('');
        });

        gtag('event', 'begin_checkout', {
            'currency': 'SAR',
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
        snaptr('track', 'START_CHECKOUT');
    </script>

@endsection
