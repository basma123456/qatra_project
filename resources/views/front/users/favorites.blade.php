@extends('layouts.app')
@section('title')
    المساجد المفضلة
@endsection
@section('css')
    <style>
        .cart-page .cart-item-wrap .swipe-to-show .delete-button {
            color: #842029;
            background-color: #f8d7da;
            border-color: #f5c2c7;
        }
    </style>
@endsection
@section('skeleton')
@endsection
@section('back_url',route("user.account"))
@section('content')
    <main class="main-wrap cart-page mb-xxl">
        <!-- Address Section Start -->
        <section class="pt-0">
            {{-- <button class="d-block btn-outline-grey" data-bs-toggle="offcanvas" data-bs-target="#add-address"
                aria-controls="add-address">+ Add New Address</button> --}}
            <div class="top-content">
                <div>
                    <h2 class="title-color">المساجد المفضلة</h2>
                    <p class="content-color"></p>
                    <hr>
                </div>
            </div>
            {{-- <div class="address-wrap">
                @foreach ($favorites as $mosque)
                    <div class="address-box">
                        <div class="conten-box">
                            <div class="heading">
                                <i class="iconly-Home icli"></i>
                                <h2 class="title-color font-md">{{ $mosque->name }}</h2>
                            </div>
                            <p class="content-color font-sm">{{ $mosque->city->name }} - {{ $mosque->district->name }}</p>
                            <a class="btn btn-danger mt-3"><i class="ri-delete-bin-line"></i></a>
                        </div>
                        <img src="{{ url('') }}/assets/images/map/map.jpg" alt="map" />
                    </div>
                @endforeach
                <!-- Address Star -->

            </div> --}}
            <div class="cart-item-wrap pt-0">
                @foreach ($favorites as $mosque)
                    <div class="swipe-to-show">
                        <div class="product-list media">
                            <a href="{{ route("front.products",$mosque->id) }}"><img src="{{ url('') }}/assets/images/map/map.jpg"
                                    alt="offer"></a>
                            <div class="media-body">
                                <a href="{{ route("front.products",$mosque->id) }}" class="font-sm"> {{ $mosque->name }} </a>
                                {{-- <span class="content-color font-xs">500g</span> --}}
                                <span class="title-color font-sm">{{ $mosque->city->name }} - {{ $mosque->district->name }}
                                </span>
                            </div>
                        </div>
                        <div class="delete-button" data-bs-toggle="offcanvas" data-bs-target="#confirmation"
                            aria-controls="confirmation">
                            <i class="ri-delete-bin-line"></i>
                        </div>
                    </div>
                    {{-- <div class="address-box">
                        <div class="conten-box">
                            <div class="heading">
                                <i class="iconly-Home icli"></i>
                                <h2 class="title-color font-md">{{ $mosque->name }}</h2>
                            </div>
                            <p class="content-color font-sm">{{ $mosque->city->name }} - {{ $mosque->district->name }}</p>
                            <a class="btn btn-danger mt-3"><i class="ri-delete-bin-line"></i></a>
                        </div>
                        <img src="{{ url('') }}/assets/images/map/map.jpg" alt="map" />
                    </div> --}}
                @endforeach
                <!-- Address Star -->

            </div>
        </section>
        <!-- Address Section End -->
    </main>
@endsection
@section('js')
    <script src="{{ url('') }}/assets/js/jquery-swipe-1.11.3.min.js"></script>
    <script src="{{ url('') }}/assets/js/jquery.mobile-1.4.5.min.js"></script>
@endsection
