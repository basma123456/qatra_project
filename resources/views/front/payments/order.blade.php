@extends('layouts.app')
@section('title')
    التأكيد والدفع
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <style>
        .iti {
            width: 100%;
        }

        .iti-mobile .iti__country-list {
            width: 90%;
        }
    </style>
@endsection
@section('skeleton')
@endsection
@section('back_url', route('front.products', $order->mosque_id))
@section('content')
    <main class="main-wrap payment-page mb-xxl">
        <form action="{{ route('front.payment.check', $order->id) }}" id="form_3" method="POST">
            @csrf
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
                    <li class="selected"><span>3</span>
                        <strong>الدفع</strong>
                    </li>
                    <li><span>4</span>
                        <strong>التأكيد</strong>
                    </li>
                </ul>
            </div>
            <section class="location-section py-0">
                <div class="">
                    <h3 class="title-color font-sm">التأكيد والدفع</h3>
                    <p class="content-color font-sm">يرجى مراجعة الطلب قبل الدفع</p>
                </div>
            </section>

            <!-- Order Detail Start -->
            <section class="order-detail">
                <h3 class="title-2">مكان التوصيل</h3>
                <!-- Product Detail  Start -->
                <ul>
                    <li>
                        <span>{{ $mosque->name }} - {{ $mosque->city->name }}</span>
                    </li>
                </ul>
                @foreach ($delivery_types as $delivery_type)
                    <div class="input-box col-6 my-3">
                        <input type="radio" name="delivery_type_id" id="delivery_type_{{ $delivery_type->id }}"
                            value="{{ $delivery_type->id }}" @if ($loop->first) checked @endif>
                        <label class="form-check-label"
                            for="delivery_type_{{ $delivery_type->id }}">{{ $delivery_type->name }}
                        </label>
                    </div>
                @endforeach
                <div class="col-12 mt-3" id="delivery_person">
                    <div class="custom-form">


                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="input-box mb-0">
                                    <input name="delivery_name" id="delivery_name" class=" form-control" type="text"
                                        placeholder="اسم المستلم" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-box mb-0">
                                    <input name="delivery_mobile" id="delivery_mobile" type="number"
                                        placeholder="رقم الجوال" class="form-control" />
                                </div>
                            </div>
                            <div class="col-12 my-2">
                                <div class="alert alert-warning" role="alert">
                                    <i class="ri-alert-line"></i> ملاحظة: في حال لم يرد الشخص على اتصالات المندوب سيتم
                                    توصيل
                                    المياه للمسجد مباشرة، وذلك بعد التنسيق معكم ومتابعتكم.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Product Detail  End -->
            </section>
            <section class="order-detail mt-3">
                <h3 class="title-2">الإهداء</h3>
                <!-- Product Detail  Start -->
                <ul>
                    <li>
                        <span>هل ترغب بإهداء هذا الطلب ؟ </span>
                    </li>
                </ul>
                <div class="row">
                    <div class="input-box col-6 my-3">
                        <input type="radio" name="is_gift_card" id="is_gift_card_0" value="0" checked>
                        <label class="form-check-label" for="is_gift_card_0">لا
                        </label>
                    </div>

                    <div class="input-box col-6 my-3">
                        <input type="radio" name="is_gift_card" id="is_gift_card_1" value="1">
                        <label class="form-check-label" for="is_gift_card_1">نعم
                        </label>
                    </div>
                </div>

                <div class="col-12 mt-3" id="gift_person">
                    <div class="custom-form">


                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="input-box mb-0">
                                    <input name="gift_sender" id="gift_sender" class=" form-control" type="text"
                                        placeholder="اسم المهدي" />
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="input-box mb-0">
                                    <input name="gift_recipient_name" id="gift_recipient_name" class=" form-control"
                                        type="text" placeholder="اسم المهدى إليه" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-box mb-0">
                                    <input name="gift_recipient_mobile1" id="gift_recipient_mobile" type="number"
                                        placeholder="رقم جوال المهدى إليه" class="form-control" />
                                    <input id="countryData" name="gift_recipient_mobile" value="" type="hidden" />
                                </div>
                            </div>
                            <div class="col-12 my-2">
                                <div class="alert alert-warning" role="alert">
                                    <i class="ri-alert-line"></i> ملاحظة: سيتم إرسال البطاقة باستخدام تطبيق الواتساب الرجاء
                                    التأكد من أن المستلم لديه واتساب على نفس الرقم.
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Product Detail  End -->
            </section>
            <section class="order-detail mt-3">
                <h3 class="title-2">تفاصيل الطلب</h3>
                <!-- Product Detail  Start -->
                <ul>
                    @foreach ($cart as $item)
                        @php
                            $details = $item->getDetails();
                        @endphp
                        <li>
                            <span>{{ $details->quantity }} × {{ $details->title }} × {{ $details->price }} ريال
                            </span>
                            <span>{{ number_format($details->total_price, 2) }}</span>
                        </li>
                    @endforeach

                    <li>
                        <span>المجموع غير شامل الضريبة</span>
                        <span>{{ number_format(($shoppingCart->getTotal() / (100 + env('SAUDI_TAX'))) * 100, 2) }}</span>
                    </li>
                    <li>
                        <span>الضريبة {{ env('SAUDI_TAX') }}% </span>
                        <span>{{ number_format(($shoppingCart->getTotal() / (100 + env('SAUDI_TAX'))) * env('SAUDI_TAX'), 2) }}</span>
                    </li>
                    <li>
                        <span>الإجمالي</span>
                        <span>{{ number_format($shoppingCart->getTotal(), 2) }}</span>
                    </li>

                </ul>
                <p class="my-3">رقم التسجيل الضريبي: 311215850700003 </p>
            </section>

            <div class="pb-5">
                <div class="input-box m-2 my-3">
                    <label class="form-check-label" for="radio19"><input type="checkbox" name="add_mosque_favorite"
                            id="radio19" value="1"> إضافة <a class="url_link">{{ $mosque->name }}</a> إلى المفضلة
                        الخاصة
                        بي </label>
                </div>
                <div class="input-box m-2 my-3 pb-5">
                    <label class="form-check-label" for="radio13"><input type="checkbox" name="radio13" id="radio13"
                            value="option1"> قرأت وأوافق على <a class="url_link" href="#">الشروط والأحكام</a> و<a
                            class="url_link" href="#">سياسة الخصوصية</a> لمنصة قطرة. </label>
                </div>
                <!-- Order Detail End -->
                <input type="hidden" name="order_id" id="order_id" value="{{ $order->id }}">
                <input type="hidden" name="payment_type_id" id="payment_type_id" value="1">
            </div>
        </form>
    </main>
    <footer class="footer-wrap footer-button">
        <button id="submit_form" class="font-md w-100"><span class="text-white">تأكيد
            </span></a>
    </footer>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script>
        var phoneInputField = document.querySelector("#gift_recipient_mobile");
        var phoneInput = window.intlTelInput(phoneInputField, {
            preferredCountries: ['sa', 'ae', 'kw', 'qa', 'bh', 'om'],
            separateDialCode: true,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            initialCountry: "auto",
            geoIpLookup: function(success, failure) {
                fetch("https://ipapi.co/json")
                    .then(function(res) { return res.json(); })
                    .then(function(data) { success(data.country_code); })
                    .catch(function() { failure(); });
            }
        });

        $("#layout_footer").hide();
        $("#delivery_person").hide();
        @foreach ($delivery_types as $delivery_type)
            $("#delivery_type_{{ $delivery_type->id }}").on("click", function(e) {
                @if ($delivery_type->id == 1)
                    $("#delivery_person").hide("slow");
                    e.stopPropagation();
                @else
                    $("#delivery_person").show("slow");
                    e.stopPropagation();
                @endif
            })
        @endforeach

        $("#gift_person").hide();
        $("#is_gift_card_1").on("click", function(e) {
            $("#gift_person").show("slow");
            e.stopPropagation();
        })
        $("#is_gift_card_0").on("click", function(e) {
            $("#gift_person").hide("slow");
            e.stopPropagation();
        })

        $('#submit_form').click(function() {
            // alert("submit_form");
            var flag = true;
            var delivery_type_id = $('input[name=delivery_type_id]:checked', '#form_3').val();
            var is_gift_card = $('input[name=is_gift_card]:checked', '#form_3').val();
            var msg = "";
            if (delivery_type_id == 0) {
                msg = "يجب اختيار طريقة التوصيل";
                flag = false;
            }
            if (delivery_type_id == 2) {
                if (!$("#delivery_name").val() || !$("#delivery_mobile").val()) {
                    msg = "يجب ادخال معلومات الشخص المستلم";
                    flag = false;
                }
            }
            var checkBox = document.getElementById('radio13');
            if (!checkBox.checked) {
                msg = "يجب الموافقة على الشروط والأحكام واتفاقية الخصوصية";
                flag = false;
            }
            // alert(is_gift_card);
            if (is_gift_card == 1) {

                var full_number = phoneInput.getNumber(intlTelInputUtils.numberFormat.E164);
                var isValid = phoneInput.isValidNumber();
                $("#countryData").val(full_number);
                if (!isValid) {
                    flag = false;
                    msg = "رقم جوال المهدى إليه غير صحيح";
                }
                if (!$("#gift_sender").val() || !$("#gift_recipient_name").val()) {
                    msg = "يجب ادخال اسم المهدي والمهدى إليه";
                    flag = false;
                }
            }


            if (flag) {
                $("#form_3").submit();
            } else {
                $("#notification-text").html(msg);
                var myOffcanvas = document.getElementById('notification-popup')
                var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas)
                bsOffcanvas.show()

            }

        });
        gtag('event', 'add_to_cart', {
            'currency': 'SAR',
            'value': {{ $shoppingCart->getTotal() }},
            items: [
                @foreach ($cart as $item)
                    @php
                        $details = $item->getDetails();
                    @endphp {
                        item_name: "{{ $details->title }}",
                        index: {{ $loop->index }},
                        price: {{ $details->price }},
                        quantity: {{ $details->quantity }}
                    }
                    @if (!$loop->last)
                        ,
                    @endif
                @endforeach
            ]
        });
        snaptr('track', 'ADD_CART');
        fbq('track', 'AddToCart', {currency: "SAR", value: '{{ $shoppingCart->getTotal() }}'});
    </script>

@endsection
