@extends('layouts.app')

@section('css')
    <style>
        .payment-method-col {
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 82px;
            height: 82px;
            margin: 0 10px 10px 10px;
            border: 0px #00a0df solid;
            border-radius: 3px;
            padding: 10px;
        }

        .payment-method-icon {
            width: 100%;
            height: auto;
        }
        .payment-logo{
            border: 1px solid #d6f1fb;
            padding: 10px;
            background-color: #fff;
            border-radius: 10px;
        }
    </style>
@endsection

@section('skeleton')
    <div class="skeleton-loader">
        <!-- Header Start -->
        <header class="header">
            <div class="logo-wrap">
               <a
                    href="{{ route('home') }}"> <img class="logo" src="{{ url('') }}/assets/images/logo/logo.png"
                        alt="logo" /></a>
            </div>
            <div class="avatar-wrap">
                {{-- <span class="font-sm"><i class="iconly-Location icli font-xl"></i> مكة المكرمة</span> --}}
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
        <section class="banner-section ratio2_1">
            <div class="h-banner-slider">
                <div>
                    <div class="banner-box">
                        <img src="{{ url('') }}/assets/slides/bnr01.jpg" alt="banner" class="bg-img" />
                    </div>
                </div>
                <div>
                    <div class="banner-box">
                        <img src="{{ url('') }}/assets/slides/bnr02.jpg" alt="banner" class="bg-img" />
                    </div>
                </div>
                <div>
                    <div class="banner-box">
                        <img src="{{ url('') }}/assets/slides/bnr01.jpg" alt="banner" class="bg-img" />
                    </div>
                </div>
                <div>
                    <div class="banner-box">
                        <img src="{{ url('') }}/assets/slides/bnr02.jpg" alt="banner" class="bg-img" />
                    </div>
                </div>


            </div>
        </section>
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

        <section class="question-section pt-2">
            {{-- <a href="{{ route('products') }}" class="btn btn-primary btn-lg btn-block">اشتري الآن </a> --}}
            <div class="top-content">
                <div class="terms-condition">
                    <h4 class="title-color mb-3  text-center" style="color:#4667ac">التبرع بالماء صار أسهل! </h4>
                    <ul class="list-section mb-4 mx-3">
                        <li class="content-color">من خلال منصة قطرة، وعبر خطوات سريعة يمكنك تحقيق ذلك بسهولة.</li>
                        <li class="content-color">فقط اختر المسجد الذي تود توزيع الماء وحدد الكمية وأتمم الدفع، ودع لنا
                            الباقي.</li>
                        <li class="content-color">سنقوم بكل ذلك نيابة عنك، مع تزويدك بتقرير مصور يوثق خطوات العمل بشكل
                            كامل.</li>
                    </ul>
                    {{-- <p class="content-color mx-3"> </p>
                    <p class="content-color mx-3">
                    </p>
                    <p class="content-color mx-3">
                    </p> --}}
                </div>
            </div>
            <div class="d-grid gap-2 d-md-block">
                <a href="{{ route('front.mosques') }}" class="btn btn-primary btn-lg">تبرّع الآن بسهولة</a>
            </div>
        </section>


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
                    <h4 class="title-color mb-4 text-center" style="font-size:16px;">التوزيع والإشراف بواسطة </h4>
                    <div class="text-center">
                        <img src="{{ url("assets/images/ehssan logo-min.png") }}" style="max-width:25%">
                    </div>
                    <div class="text-center mt-2">جمعية الإحسان الخيرية بمكة </div>

                </div>
            </div>
        </section>
        <!-- Question section End -->
    </main>
@endsection
@section('js')
    <script src="{{ url('') }}/assets/js/slick.js"></script>
    <script src="{{ url('') }}/assets/js/slick.min.js"></script>
    <script src="{{ url('') }}/assets/js/slick-custom.js?v=1"></script>
@endsection
