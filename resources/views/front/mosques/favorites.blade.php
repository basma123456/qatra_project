@extends('layouts.app')
@section('title')
@endsection
@section('css')
@endsection
@section('skeleton')
@endsection

@section('content')
    <main class="main-wrap address2-page mb-xxl">
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
            <div class="address-wrap">


                <!-- Address Star -->
                <div class="address-box">
                    <div class="conten-box">
                        <div class="heading">
                            <i class="iconly-Home icli"></i>
                            <h2 class="title-color font-md">مسجد النورين</h2>
                        </div>
                        <p class="content-color font-sm">مكة - حي العوالي</p>
                    </div>
                    <img src="assets/images/map/map.jpg" alt="map" />
                </div>
                <!-- Address End -->

                <!-- Address Star -->
                <div class="address-box">
                    <div class="conten-box">
                        <div class="heading">
                            <i class="iconly-Home icli"></i>
                            <h2 class="title-color font-md">مسجد زرقاء اليمامة</h2>
                        </div>
                        <p class="content-color font-sm">مكة - حي الشرفية</p>
                    </div>
                    <img src="assets/images/map/map.jpg" alt="map" />
                </div>
                <!-- Address End -->

                <!-- Address Star -->
                <div class="address-box">
                    <div class="conten-box">
                        <div class="heading">
                            <i class="iconly-Home icli"></i>
                            <h2 class="title-color font-md">مسجد الإمام ابن باز</h2>
                        </div>
                        <p class="content-color font-sm">مكة - حي التوفيق</p>
                    </div>
                    <img src="assets/images/map/map.jpg" alt="map" />
                </div>
                <!-- Address End -->
            </div>
        </section>
        <!-- Address Section End -->
    </main>
@endsection
@section('js')
@endsection
