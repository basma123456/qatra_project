@extends('layouts.app')
@section('title')
@endsection
@section('css')
@endsection
@section('skeleton1')
    <div class="skeleton-loader">
        <!-- Header Start -->
        <header class="header">
            <div class="logo-wrap">
                <a href="{{ route('home') }}"> <img class="logo logo-w" src="{{ url('') }}/assets/images/logo/Qat-logo-n4.png"
                        alt="logo" /></a><a href="{{ route('home') }}"> <img class="logo"
                        src="{{ url('') }}/assets/images/logo/Qat-logo-n4.png" alt="logo" /></a>
            </div>
            <div class="avatar-wrap">
                <span class="font-sm"><i class="iconly-Location icli font-xl"></i> مكة المكرمة</span>
                <a href="account.html"> <img class="avatar" src="{{ url('') }}/assets/images/avatar/avatar.jpg"
                        alt="avatar" /></a>
            </div>
        </header>
        <!-- Header End -->
        {{-- <div class="search-box">
            <div>
                <i class="iconly-Search icli search"></i>
                <input class="form-control" type="search" placeholder="ابحث هنا ..." />
                <i class="iconly-Voice icli mic"></i>
            </div>
            <button class="filter font-md" type="button" data-bs-toggle="offcanvas" data-bs-target="#filter"
                aria-controls="filter">بحث</button>
        </div> --}}
        <!--Main Start -->
        <div class="main-wrap shop-page mb-xxl overflow-hidden">
            <!-- Catagories Tabs  Start -->


            <!-- Tab Content Start -->
            <div class="tab-content ratio2_1" id="pills-tabContent-sk">
                <!-- Catagories Content Start -->
                <div class="tab-pane fade show active" id="catagories1-sk" role="tabpanel"
                    aria-labelledby="catagories1-tab-sk">
                    <div class="product-list media">
                        <div class="link">
                            <div class="img"></div>
                        </div>
                        <div class="media-body">
                            <a href="javascript:void(0)" class="font-sm"> Assorted Capsicum Combo </a>
                            <span class="content-color font-xs">500g</span>
                            <span class="title-color font-sm"><span> $34.00</span> <span class="badges-round font-xs">50%
                                    off</span></span>
                            <div class="plus-minus"></div>
                        </div>
                    </div>

                    <div class="product-list media">
                        <div class="link">
                            <div class="img"></div>
                        </div>
                        <div class="media-body">
                            <a href="javascript:void(0)" class="font-sm"> Assorted Capsicum Combo </a>
                            <span class="content-color font-xs">500g</span>
                            <span class="title-color font-sm"><span> $21.00</span> <span class="badges-round font-xs">50%
                                    off</span></span>
                            <div class="plus-minus"></div>
                        </div>
                    </div>

                    <div class="product-list media">
                        <div class="link">
                            <div class="img"></div>
                        </div>
                        <div class="media-body">
                            <a href="javascript:void(0)" class="font-sm"> Assorted Capsicum Combo </a>
                            <span class="content-color font-xs">500g</span>
                            <span class="title-color font-sm"><span> $33.00</span> <span class="badges-round font-xs">50%
                                    off</span></span>
                            <div class="plus-minus"></div>
                        </div>
                    </div>

                    <!-- Banner Start -->
                    <div class="banner">
                        <img src="assets/images/banner/shop.jpg" class="img-fluid" alt="banner" />
                        <h2>100% Organic, Best Quality, Best price</h2>
                    </div>
                    <!-- Banner End -->

                    <div class="product-list media">
                        <div class="link">
                            <div class="img"></div>
                        </div>
                        <div class="media-body">
                            <a href="javascript:void(0)" class="font-sm"> Assorted Capsicum Combo </a>
                            <span class="content-color font-xs">500g</span>
                            <span class="title-color font-sm"><span> $45.00</span> <span class="badges-round font-xs">50%
                                    off</span></span>
                            <div class="plus-minus"></div>
                        </div>
                    </div>

                    <div class="product-list media">
                        <div class="link">
                            <div class="img"></div>
                        </div>
                        <div class="media-body">
                            <a href="javascript:void(0)" class="font-sm"> Assorted Capsicum Combo </a>
                            <span class="content-color font-xs">500g</span>
                            <span class="title-color font-sm"><span> $18.00</span> <span class="badges-round font-xs">50%
                                    off</span></span>
                            <div class="plus-minus"></div>
                        </div>
                    </div>

                    <div class="product-list media">
                        <div class="link">
                            <div class="img"></div>
                        </div>
                        <div class="media-body">
                            <a href="javascript:void(0)" class="font-sm"> Assorted Capsicum Combo </a>
                            <span class="content-color font-xs">500g</span>
                            <span class="title-color font-sm"><span> $36.00</span> <span class="badges-round font-xs">50%
                                    off</span></span>
                            <div class="plus-minus"></div>
                        </div>
                    </div>

                    <div class="product-list media">
                        <div class="link">
                            <div class="img"></div>
                        </div>
                        <div class="media-body">
                            <a href="javascript:void(0)" class="font-sm"> Assorted Capsicum Combo </a>
                            <span class="content-color font-xs">500g</span>
                            <span class="title-color font-sm"><span> $23.00</span> <span class="badges-round font-xs">50%
                                    off</span></span>
                            <div class="plus-minus"></div>
                        </div>
                    </div>

                    <div class="product-list media">
                        <div class="link">
                            <div class="img"></div>
                        </div>
                        <div class="media-body">
                            <a href="javascript:void(0)" class="font-sm"> Assorted Capsicum Combo </a>
                            <span class="content-color font-xs">500g</span>
                            <span class="title-color font-sm"><span> $15.00</span> <span class="badges-round font-xs">50%
                                    off</span></span>
                            <div class="plus-minus"></div>
                        </div>
                    </div>

                    <div class="product-list media">
                        <div class="link">
                            <div class="img"></div>
                        </div>
                        <div class="media-body">
                            <a href="javascript:void(0)" class="font-sm"> Assorted Capsicum Combo </a>
                            <span class="content-color font-xs">500g</span>
                            <span class="title-color font-sm"><span> $22.00</span> <span class="badges-round font-xs">50%
                                    off</span></span>
                            <div class="plus-minus"></div>
                        </div>
                    </div>
                </div>
                <!-- Catagories Content End -->
            </div>
            <!-- Tab Content End -->
        </div>
    </div>
@endsection
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
        <div class="row">
            <div class="col-10"><p class="border border-light rounded bg-light p-2">مسجد النورين - مكة المكرمة - حي العدل</div>
            <div class="col-2"><a href="{{ route("mosques") }}" class="btn btn-outline-secondary"><i class="ri-pencil-line"></i></a></div>
        </div>
        <div class="offer-section">
            
            <div class="offer">
                
                <div class="offer-wrap">
                    <div class="product-list media">
                        <a href="{{ route('home') }}"><img src="{{ url('') }}/assets/images/product/water.jpg"
                                alt="offer" /></a>
                        <div class="media-body">
                            <a href="{{ route('home') }}" class="font-sm"> 10 كراتين </a>
                            <span class="content-color font-xs">كل كرتون يحتوي على 20 قارورة ماء سعة 300 مل</span>
                            <span class="title-color font-sm">200 ريال</span>
                            <div class="plus-minus d-xs-none">
                                <i class="sub" data-feather="minus"></i>
                                <input type="number" value="1" min="0" max="10" />
                                <i class="add" data-feather="plus"></i>
                            </div>
                        </div>
                    </div>
                    @for ($i = 20; $i <= 100; $i = $i + 10)
                        <div class="product-list media">
                            <a href="{{ route('home') }}"><img src="{{ url('') }}/assets/images/product/water.jpg"
                                    alt="offer" /></a>
                            <div class="media-body">
                                <a href="{{ route('home') }}" class="font-sm"> {{ $i }} كرتون </a>
                                <span class="content-color font-xs">كل كرتون يحتوي على 20 قارورة ماء سعة 300 مل</span>
                                <span class="title-color font-sm">{{ $i * 20 }} ريال</span>
                                <div class="plus-minus d-xs-none">
                                    <i class="sub" data-feather="minus"></i>
                                    <input type="number" value="1" min="0" max="10" />
                                    <i class="add" data-feather="plus"></i>
                                </div>
                            </div>
                        </div>
                    @endfor

                </div>

            </div>
        </div>

    </main>

    <footer class="footer-wrap shop">
        <ul class="footer">
            <li class="footer-item"><span class="font-xs">3 منتجات</span> <span class="font-sm">2300 ريال</span></li>
            <li class="footer-item">
                <a href="{{ route("payment") }}" class="font-md">الدفع <i data-feather="chevron-right"></i></a>
            </li>
        </ul>
    </footer>
@endsection
@section('js')
    <script>
        $("#layout_footer").hide();
    </script>
@endsection
