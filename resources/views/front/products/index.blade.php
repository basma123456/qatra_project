@extends('layouts.app')

@section('title')
    تحديد الكمية
@endsection

@section('css')
@endsection
@section('skeleton')
@endsection
@section('back_url', route('front.mosques'))
@section('content')
    <main class="main-wrap shop-page mb-xxl">
        <div class="steps">
            <ul>
                <li class="selected">
                    <span class=""><i class="ri-check-line"></i></span>
                    <strong class="">المسجد</strong>
                </li>
                <li class="selected">
                    <span>2</span>
                    <strong>الكمية</strong>
                </li>
                <li><span>3</span>
                    <strong>الدفع</strong>
                </li>
                <li><span>3</span>
                    <strong>التأكيد</strong>
                </li>
            </ul>
        </div>
        <div class="">
            <h3 class="title-color font-sm">تحديد الكمية</h3>
            <p class="content-color font-sm">فضلاً حدد الكمية المطلوبة من الباقات المتاحة</p>
        </div>
        <div class="border border-light rounded mb-3 p-2">
            <div class="row">
                <div class="col-10 text-start">
                    <b>اسم المسجد: </b>{{ $mosque->name_ar }}
                </div>
                <div class="col-2 text-end">
                    <a href="{{ route('front.mosques') }}"><i class="ri-edit-line"></i></a>
                </div>

            </div>
        </div>
        <div class="offer-section">

            <div class="offer pb-5">

                <div class="offer-wrap pb-5">
                    <form action="{{ route('front.payment') }}" method="POST" id="form_items">
                        @csrf
                        @foreach ($products as $product)
                            <div class="product-list media">
                                <a><img src="{{ url('') }}/assets/images/product/water.jpg" alt="offer" /></a>
                                <div class="media-body">
                                    <a class="font-sm"> {{ $product->name }}</a>
                                    <span class="content-color font-xs">{!! $product->description !!}</span>
                                    <span class="title-color font-sm">{{ number_format($product->price) }} ريال</span>
                                    <div class="plus-minus">

                                        <i class="add" data-feather="plus"></i>
                                        <input name="products[{{ $product->id }}]" type="number" class="product_item"
                                            data-price="{{ $product->price }}" value="0" min="0"
                                            max="10" />
                                        <i class="sub" data-feather="minus"></i>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <input type="hidden" name="mosque_id" value="{{ $mosque->id }}" />
                    </form>

                </div>

            </div>
        </div>

    </main>

    <footer class="footer-wrap shop">
        <ul class="footer">
            <li class="footer-item"><span class="font-xs" id="total_product"></span> <span class="font-sm"
                    id="total_amount">0 ريال</span></li>
            <li class="footer-item">
                <a id="send_items" class="font-md  w-100">الدفع <i data-feather="chevron-right"></i></a>
            </li>
        </ul>
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
    <script>
        $("#layout_footer").hide();
        $(".product_item").on('input', function(e) {
            // alert('Changed!');
        });

        $('#send_items').on('click', function(e) {
            e.preventDefault();
            if (total_amount > 0) {
                $(this).attr('disabled', 'disabled');
                $(this).html(
                    '<div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>'
                );
                $("#form_items").submit();
            } else {
                msg = "لم يتم اختيار منتجات !!";
                $("#notification-text").html(msg);
                var myOffcanvas = document.getElementById('notification-popup')
                var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas)
                bsOffcanvas.show()
            }

        });
        $('.add').on('click', function() {
            if ($(this).next().val() < 10) {
                var new_val = +$(this).next().val() + 1;
                $(this).next().val(new_val);
            }
            updateTotal();
        });
        $('.sub').on('click', function() {
            if ($(this).prev().val() > 0) {
                var new_val = +$(this).prev().val() - 1
                if ($(this).prev().val() > 0) {
                    $(this).prev().val(new_val);
                }
                updateTotal();
            }
        });
        $('.product_item').on('change', function() {
            var new_val = $(this).val()
            if (new_val > 10) {
                $(this).val(10);
            }
            if (new_val < 0) {
                $(this).val(0);
            }
            updateTotal();
        });

        function updateTotal() {
            total_product = 0;
            total_amount = 0;
            $('.product_item').each(function() {
                var currentElement = $(this);
                var price = parseInt(currentElement.data("price"));
                var quantity = parseInt(currentElement.val());
                total_product += quantity;
                total_amount += parseInt(quantity * price);
            });
            $("#total_product").html(total_product + " منتجات")
            $("#total_amount").html(total_amount + " ريال")
        }

        updateTotal();
        gtag('event', 'choose_mosque', {
            'mosque_id': '{{ $mosque->id }}',
            'mosque_name': '{{ $mosque->name_ar }}'
        });
        snaptr('track', 'choose_mosque');
    </script>
@endsection
