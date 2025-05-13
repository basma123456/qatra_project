@extends('layouts.app')
@section('title')
@endsection
@section('css')
@endsection
@section('skeleton')
@endsection
@section('content')
    <main class="main-wrap notification-page mb-xxl">

        <!-- Tab Content Start -->
        <section class="tab-content ratio2_1" id="pills-tabContent">
            <!-- Alert Content Start -->
            <div class="tab-pane fade show active" id="offer1" role="tabpanel" aria-labelledby="offer1-tab">
                <!-- Yesterday Start -->
                <div class="offer-wrap">
                    <!-- Offer Box Start -->
                    <div class="offer-box">
                        <div class="media">
                            <div class="icon-wrap bg-theme-blue">
                                <i class="ri-notification-3-line icli"></i>
                            </div>
                            <div class="media-body">
                                <h3 class="font-sm title-color">استقبال إشعارات بخصوص طلباتي</h3>
                                <span class="font-xs content-color"></span>
                            </div>
                            <div class="ms-5">
                                <div class="dark-switch">
                                    <input id="darkButton1" type="checkbox" checked />
                                    <span class="before-none"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Offer Box End -->

                    <!-- Offer Box Start -->
                    <div class="offer-box">
                        <div class="media">
                            <div class="icon-wrap bg-theme-yellow-light">
                                <i class="ri-notification-3-line icli"></i>
                            </div>
                            <div class="media-body">
                                <h3 class="font-sm title-color">استقبال عروض حصرية</h3>
                                <span class="font-xs content-color"></span>
                            </div>
                            <div class="ms-5">
                            <div class="dark-switch">
                                <input id="darkButton2" type="checkbox" />
                                <span class="before-none"></span>
                            </div>
                            </div>
                        </div>
                    </div>
                    <!-- Offer Box End -->
                </div>
                <!-- Yesterday End -->

            </div>
        </section>
        <!-- Tab Content End -->
    </main>
@endsection
@section('js')
@endsection
