@extends('layouts.app')
@section('title')
طلباتي
@endsection
@section('css')
@endsection
@section('skeleton')
@endsection
@section('back_url',route("user.account"))
@section('content')
    <main class="main-wrap order-history mb-xxl">
        <!-- Catagories Tabs  Start -->
        <ul class="nav nav-tab nav-pills custom-scroll-hidden" id="pills-tab" role="tablist">
            @foreach ($orders as $key => $rows)
                <li class="nav-item" role="presentation">
                    <button class="nav-link @if ($loop->index == 0) active @endif"
                        id="catagories{{ $loop->index }}-tab" data-bs-toggle="pill"
                        data-bs-target="#catagories{{ $loop->index }}" type="button" role="tab"
                        aria-controls="catagories{{ $loop->index }}"
                        aria-selected="@if ($loop->index == 0) true @else false @endif ">
                        {{ $key }}
                    </button>
                </li>
            @endforeach



        </ul>
        <!-- Catagories Tabs  End -->

        <!-- Search Box Start -->
        <div class="search-box">
            <div>
                <i class="iconly-Search icli search"></i>
                <input class="form-control" type="search" placeholder="ابحث عن طلب سابق..." />
                <i class="iconly-Voice icli mic"></i>
            </div>
            <button class="filter font-md" type="button" data-bs-toggle="offcanvas" data-bs-target="#filter"
                aria-controls="filter">بحث</button>
        </div>
        <!-- Search Box End -->

        <!-- Tab Content Start -->
        <section class="tab-content ratio2_1" id="pills-tabContent">
            @if (count($orders) > 0)
                @foreach ($orders as $key => $rows)
                    <div class="tab-pane fade @if ($loop->index == 0) show active @endif"
                        id="catagories{{ $loop->index }}" role="tabpanel"
                        aria-labelledby="catagories{{ $loop->index }}-tab">
                        @foreach ($rows as $item)
                            <!-- Order Box Start -->
                            <div class="order-box">
                                <div class="media">
                                    <a href="{{ route('front.orders.item', $item->id) }}" class="content-box">
                                        <h2 class="font-sm title-color">رقم الطلب: #{{ $item->id }} </h2>
                                        <h2 class="font-sm title-color">
                                            التاريخ:{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d M Y') }}
                                        </h2>
                                        <p class="font-xs content-color">{{ $item->mosque->name }}</p>
                                        <span class="content-color font-xs">المبلغ: <span
                                                class="font-theme">{{ number_format($item->total) }} ريال</span>, الحالة:
                                            <span class="font-theme">{{ $item->order_status->name }}</span></span>
                                    </a>
                                    <div class="media-body">
                                        <a href="#"><img src="{{ url('') }}/assets/images/map/map.jpg"
                                                alt="map" /></a>
                                    </div>
                                </div>
                                <div class="bottom-content">
                                    <a href="{{ route("front.products",$item->mosque_id) }}" class="title-color font-sm fw-600"><i class="ri-restart-line"></i>
                                        إعادة
                                        الطلب </a>
                                    <a href="{{ route('front.orders.track', $item->id) }}"
                                        class="title-color font-sm fw-600"><i class="ri-road-map-line"></i> تتبع الطلب </a>
                                </div>
                            </div>
                            <!-- Order Box End -->
                        @endforeach

                        {{-- <div class="text-center p-4">
                        <div class="spinner-border" role="status">
                            <span class="sr-only"></span>
                        </div>
                    </div> --}}

                    </div>
                @endforeach
            @else
                <div class="row">
                    <div class="col-12 text-center mb-3 mt-5">
                        <img src="{{ url('/assets/images/empty.png') }}" class="" style="width: 50px" />
                    </div>
                    <div class="col-12 text-center">
                        <p class="content-color">لا توجد لديك طلبات سابقة</p>
                    </div>
                </div>
            @endif

        </section>
    </main>
@endsection
@section('js')
@endsection
