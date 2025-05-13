@extends('layouts.app')

@section('title')
    توصيل الماء لمسجدك صار أسهل
@endsection
@section('css')
    <style>
        .payment-method-col {
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 82px;
            height: 52px;
            margin: 0 10px 10px 10px;
            border: 0px #00a0df solid;
            border-radius: 3px;
            padding: 10px;
        }

        .payment-method-icon {
            width: 100%;
            height: auto;
        }

        .payment-logo {
            border: 1px solid #d6f1fb;
            padding: 10px;
            background-color: #fff;
            border-radius: 10px;
        }

        .btn-primary:hover {
            background-color: #4667ac !important;
            border-color: #4667ac !important;
        }

        .btn-check:focus+.btn-primary,
        .btn-primary:focus {
            background-color: #4667ac !important;
            border-color: #4667ac !important;
        }

        .btn-check:checked+.btn-primary,
        .btn-check:active+.btn-primary,
        .btn-primary:active,
        .btn-primary.active,
        .show>.btn-primary.dropdown-toggle {
            background-color: #4667ac !important;
            border-color: #4667ac !important;
        }
    </style>
@endsection

@section('skeleton1')
    <div class="skeleton-loader">
        <!-- Header Start -->
        <header class="header">
            <div class="logo-wrap">
                <a href="{{ route('front.home') }}"> <img class="logo"
                        src="{{ url('') }}/assets/images/logo/Qat-logo-n4.png" alt="logo" /></a>
            </div>
            <div class="avatar-wrap">
                <span class="font-sm"><i class="iconly-Location icli font-xl"></i> مكة المكرمة</span>
                <a href="account.html"> <img class="avatar" src="{{ url('') }}/assets/images/avatar/avatar.jpg"
                        alt="avatar" /></a>
            </div>
        </header>
        <!-- Header End -->

        <!--Main Start -->
        <div class="main-wrap index-page mb-xxl">
            <!-- Search Box Start -->
            <div class="search-box">
                <input class="form-control" disabled type="search" />
            </div>
            <!-- Search Box End -->

            <!-- Banner Section Start -->
            <div class="banner-section section-p-t ratio2_1">
                <div class="h-banner-slider">
                    <div>
                        <div class="banner-box">
                            <div class="bg-img"></div>
                        </div>
                    </div>
                    <div>
                        <div class="banner-box">
                            <div class="bg-img"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Banner Section End -->

            <!-- Buy from Recently Bought Start -->
            <div class="recently section-p-t">
                <div class="recently-wrap">
                    <h3 class="font-md sk-hed"></h3>
                    <img class="corner" src="{{ url('') }}/assets/svg/corner-sk.svg" alt="corner" />
                    <ul class="recently-list">
                        <li class="item">
                            <div class="img"></div>
                        </li>
                        <li class="item">
                            <div class="img"></div>
                        </li>
                        <li class="item">
                            <div class="img"></div>
                        </li>
                        <li class="item">
                            <div class="img"></div>
                        </li>
                        <li class="item">
                            <div class="img"></div>
                        </li>
                        <li class="item">
                            <div class="img"></div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Buy from Recently Bought End -->

            <!-- Shop By Category Start -->
            <div class="category section-p-t">
                <h3 class="font-sm"><span></span><span class="line"></span></h3>
                <div class="row gy-sm-4 gy-2">
                    <div class="col-3">
                        <div class="category-wrap">
                            <div class="bg-shape"></div>
                            <span class="font-xs title-color"></span>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="category-wrap">
                            <div class="bg-shape"></div>
                            <span class="font-xs title-color"></span>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="category-wrap">
                            <div class="bg-shape"></div>
                            <span class="font-xs title-color"></span>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="category-wrap">
                            <div class="bg-shape"></div>
                            <span class="font-xs title-color"></span>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="category-wrap">
                            <div class="bg-shape"></div>
                            <span class="font-xs title-color"></span>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="category-wrap">
                            <div class="bg-shape"></div>
                            <span class="font-xs title-color"></span>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="category-wrap">
                            <div class="bg-shape"></div>
                            <span class="font-xs title-color"></span>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="category-wrap">
                            <div class="bg-shape"></div>
                            <span class="font-xs title-color"> </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Shop By Category End -->

            <!-- Say hello to Offers! Start -->
            <div class="offer-section section-p-t">
                <div class="offer">
                    <div class="top-content">
                        <div>
                            <h4 class="title-color">Say hello to Offers!</h4>
                            <p class="content-color">Best price ever of all the time</p>
                        </div>
                        <a href="javascript(0)" class="font-xs font-theme">See all</a>
                    </div>

                    <div class="offer-wrap">
                        <div class="product-list media">
                            <a href="javascript(0)"><img src="{{ url('') }}/assets/images/product/8.png"
                                    alt="offer" /></a>
                            <div class="media-body">
                                <a href="javascript(0)" class="font-sm"> Assorted Capsicum Combo </a>
                                <span class="content-color font-xs">500g</span>
                                <span class="title-color font-sm">$25.00 <span
                                        class="badges-round bg-theme-theme font-xs">50% off</span></span>
                                <div class="plus-minus d-xs-none">
                                    <i class="sub" data-feather="minus"></i>
                                    <input type="number" value="1" min="0" max="10" />
                                    <i class="add" data-feather="plus"></i>
                                </div>
                            </div>
                        </div>

                        <div class="product-list media">
                            <a href="javascript(0)"><img src="{{ url('') }}/assets/images/product/6.png"
                                    alt="offer" /></a>
                            <div class="media-body">
                                <a href="javascript(0)" class="font-sm"> Assorted Capsicum Combo </a>
                                <span class="content-color font-xs">500g</span>
                                <span class="title-color font-sm">$25.00 <span
                                        class="badges-round bg-theme-theme font-xs">50% off</span></span>
                                <div class="plus-minus d-xs-none">
                                    <i class="sub" data-feather="minus"></i>
                                    <input type="number" value="1" min="0" max="10" />
                                    <i class="add" data-feather="plus"></i>
                                </div>
                            </div>
                        </div>

                        <div class="product-list media">
                            <a href="javascript(0)"><img src="{{ url('') }}/assets/images/product/7.png"
                                    alt="offer" /></a>
                            <div class="media-body">
                                <a href="javascript(0)" class="font-sm"> Assorted Capsicum Combo </a>
                                <span class="content-color font-xs">500g</span>
                                <span class="title-color font-sm">$25.00 <span
                                        class="badges-round bg-theme-theme font-xs">50% off</span></span>
                                <div class="plus-minus d-xs-none">
                                    <i class="sub" data-feather="minus"></i>
                                    <input type="number" value="1" min="0" max="10" />
                                    <i class="add" data-feather="plus"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Say hello to Offers! End -->
        </div>
        <!--Main End -->
    </div>
@endsection
@section('content')
    <main class="main-wrap index-page mb-xxl">
        <!-- Search Box Start -->

        <!-- Search Box End -->

        <!-- Banner Section Start -->


        @if ($sliders->count() > 0)
            <section class="banner-section ratio2_1 pt-0">
                <div class="h-banner-slider">
                    @foreach ($sliders as $slider)
                        <div>
                            <div class="banner-box" style="">
                                {{-- <p>{{ $slider->img }} Test</p> --}}
                                <a href="https://qatra.sa/mosques">
                                    <img src="{{ url($slider->img) }}" alt="banner" class="bg-img" />
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
        <!-- Banner Section End -->

        <!-- Buy from Recently Bought Start -->

        <!-- Buy from Recently Bought End -->

        <!-- Shop By Category Start -->
        {{-- <section class="category pt-0">
            <h3 class="font-md"><span>تصفح المنتجات حسب القسم</span><span class="line"></span></h3>
            <div class="row gy-sm-4 gy-2">
                <div class="col-3">
                    <div class="category-wrap">
                        <div class="bg-shape bg-theme-blue border-blue"></div>
                        <a href="{{ route('products') }}"> <img class="category img-fluid"
                                src="{{ url('') }}/assets/images/categ-1.png" alt="category" /> </a>
                        <span class="title-color">ماء</span>
                    </div>
                </div>

                <div class="col-3">
                    <div class="category-wrap">
                        <div class="bg-shape bg-theme-yellow border-yellow"></div>
                        <a href="{{ route('products') }}"> <img class="category img-fluid"
                                src="{{ url('') }}/assets/images/categ-2.png" alt="category" /> </a>
                        <span class="title-color">تمور</span>
                    </div>
                </div>

                <div class="col-3">
                    <div class="category-wrap">
                        <div class="bg-shape bg-theme-orange border-orange"></div>
                        <a href="{{ route('products') }}"> <img class="category img-fluid"
                                src="{{ url('') }}/assets/images/categ-3.png" alt="category" /> </a>
                        <span class="title-color">ثلاجات</span>
                    </div>
                </div>

            </div>
        </section> --}}
        <!-- Shop By Category End -->




        <section class="coupons-section pt-0">
            <div class="coupon-wrap">
                <div class="top-content">
                    <div>
                        <h4 class="title-color">دفع إلكتروني آمن </h4>
                        <p class="content-color">مع خيارات دفع متنوعة تلبي رغباتكم </p>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col payment-method-col payment-logo">
                            <img src="{{ url('') }}/assets/images/payments/mada-color.svg"
                                class="payment-method-icon unveil-img">
                        </div>
                        <div class="col payment-method-col payment-logo">
                            <img src="{{ url('') }}/assets/images/payments/apple_pay.svg"
                                class="payment-method-icon unveil-img">
                        </div>
                        <div class="col payment-method-col payment-logo">
                            <img src="{{ url('') }}/assets/images/payments/visa-color.svg"
                                class="payment-method-icon unveil-img">
                        </div>
                        <div class="col payment-method-col payment-logo">
                            <img src="{{ url('') }}/assets/images/payments/mastercard-color.svg"
                                class="payment-method-icon unveil-img">
                        </div>
                    </div>
                </div>


            </div>
        </section>
        <!-- Coupens For You End -->

        <!-- Lowest Price 2 Start -->

        <!-- Lowest Price 2 End -->

        <!-- Question section Start -->
        <section class="question-section pt-2">
            {{-- <a href="{{ route('products') }}" class="btn btn-primary btn-lg btn-block">اشتري الآن </a> --}}
            <div class="top-content">
                <div class="terms-condition">
                    <div class="row mb-3">
                        <div class="col-8">
                            <h4 class="title-color my-2" style="color:#4667ac">طلب الماء صار أسهل! </h4>
                        </div>
                        <div class="col-4">
                            <div class="d-grid gap-2 d-md-block">
                                {{-- <a 
                                    class="btn btn-primary btn  btn_not_available">أطلب
                                    الآن</a> --}}
                                <a href="{{ route('front.mosques',['aff'=>$code]) }}"
                                    class="btn btn-primary btn disableafterclick">أطلب
                                    الآن</a>
                            </div>
                        </div>
                    </div>

                    <ul class="list-section mb-4 mx-3">
                        <li class="content-color">من خلال منصة قطرة خير، وعبر خطوات سريعة يمكنك تحقيق ذلك بسهولة.</li>
                        <li class="content-color">فقط اختر المسجد الذي ترغب توصيل الماء له وحدد الكمية وأتمم الدفع، ودع لنا
                            الباقي.</li>
                        <li class="content-color">سنقوم بكل ذلك نيابة عنك، مع تزويدك بتقرير مصور يوثق خطوات العمل بشكل
                            كامل.</li>
                        <li class="content-color">متخصصون في بيع المياه وتوزيعها للمساجد داخل حدود الحرم المكي</li>
                    </ul>
                    <div class="d-grid gap-2 d-md-block">
                        {{-- <a 
                            class="btn btn-primary btn-lg  btn_not_available">أطلب
                            الآن</a> --}}
                        <a href="{{ route('front.mosques',['aff'=>$code]) }}"
                            class="btn btn-primary btn-lg disableafterclick">أطلب
                            الآن</a>
                    </div>
                    {{-- <p class="content-color mx-3"> </p>
                    <p class="content-color mx-3">
                    </p>
                    <p class="content-color mx-3">
                    </p> --}}
                </div>
            </div>

        </section>
        <section class="question-section pt-2 pb-5">
            <p class="text-center mb-0"><a href="https://maroof.sa/261803" target="_blank"><img
                        src="{{ url('assets/images/maroof.svg') }}" /></a></p>
            <p class="small text-center content-color mt-0  pb-5">المتجر مسجل رسمياً في دليل معروف </p>
            {{-- <a href="{{ route('products') }}" class="btn btn-primary btn-lg btn-block">اشتري الآن </a> --}}
            {{-- <div class="top-content">
                <div class="terms-condition">
                    <h4 class="title-color mb-4 text-center" style="font-size:16px;">التوزيع والإشراف بواسطة </h4>
                    <div class="text-center">
                        <img src="{{ url('assets/images/ehssan logo-min.png') }}" style="max-width:25%">
                    </div>
                    <div class="text-center mt-2">جمعية الإحسان \ بمكة </div>

                </div>
            </div> --}}
        </section>
        <!-- Question section End -->
    </main>
    {{-- <div class="offcanvas offcanvas-bottom addtohome-popup notification-popup" tabindex="-1" id="notification-popup">
        <div class="offcanvas-body small">
            <div class="app-info">
                <div class="content">
                    <h3>Notes <i data-feather="x" data-bs-dismiss="offcanvas"></i></h3>
                </div>
            </div>
            <p class="my-2" id="notification-text"></p>
            <a class="btn-solid install-app" target="_blank" href="https://play.google.com/store/games">Go to Store</a>
        </div>
    </div> --}}

    <div class="offcanvas offcanvas-bottom addtohome-popup notification-popup" tabindex="-1" id="notification-popup">
        <div class="offcanvas-body small">
            <div class="app-info">
                <div class="content">
                    <h3>تنبيه <i data-feather="x" data-bs-dismiss="offcanvas"></i></h3>
                </div>
            </div>
            <p class="my-2" id="notification-text">عفواً ... الخدمة غير متاحة حالياً</p>
            <button class="btn-solid install-app" data-bs-dismiss="offcanvas">إغلاق</button>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ url('') }}/assets/js/slick.js"></script>
    <script src="{{ url('') }}/assets/js/slick.min.js"></script>
    <script src="{{ url('') }}/assets/js/slick-custom.js?v=1"></script>
    <script>
        // msg = "There new version of App please update it Now";

        // $("#notification-text").html(msg);
        // var myOffcanvas = document.getElementById('notification-popup')
        // var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas)
        // bsOffcanvas.show()
        $(".btn_not_available").on("click", function(){
            var myOffcanvas = document.getElementById('notification-popup')
            var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas)
            bsOffcanvas.show()
        });
    </script>
@endsection
