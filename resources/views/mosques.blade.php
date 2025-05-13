@extends('layouts.app')
@section('title')
@endsection
@section('css')
    <link rel="stylesheet" href="{{ url('') }}/assets/css/yogamap.css?v={{ time() }}">
    <style>
        .ini_class {
            min-height: 100px;
        }
    </style>
@endsection
@section('skeleton')
@endsection
@section('content')
    <main class="main-wrap address1-page  mb-xxl">
        <!-- Map Start -->
        <div class="steps">
            <ul>
                <li class="selected">
                    <span class="">1</span>
                    <strong class="">المسجد</strong>
                </li>
                <li class="">
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
        <section class="location-section">
            <div class="">
                <h3 class="title-color font-sm">تحديد المسجد</h3>
                <p class="content-color font-sm">حدد المسجد الذي تود التوزيع فيه </p>
                <div class="custom-form">
                    <div class="input-box">
                        <select name="" class="select-control" style="width: 100%">
                            <option>مكة المكرمة</option>
                            <option>المدينة المنورة</option>
                        </select>
                    </div>
                </div>
            </div>
        </section>

        <div class="map-wrap">
            <div class="ini_class">
                <div class="p-5 m-5 text-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only"></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Map End -->

        <!-- Location Section Start -->
        <section class="location-section">
            <!-- Search Box Start -->
            <div class="search-box">
                <i class="iconly-Search icli search"></i>
                <input class="form-control" type="search" placeholder="ابحث عن مسجد..." />
                <i class="iconly-Voice icli mic"></i>
            </div>
            <!-- Search Box End -->

            <div class="current-box">
                <div class="media">
                    <span><i data-feather="send"></i></span>
                    <div class="media-body">
                        <h2 class="font-md title-color">اختر المساجد المفضلة</h2>
                    </div>
                </div>

                <div class="location">
                    <div class="location-box">
                        <h3 class="title-color font-sm"><i class="iconly-Location icli"></i>مسجد ذو النودين</h3>
                        <p class="content-color font-sm">مكة حي العوالي</p>
                    </div>

                    <div class="location-box">
                        <h3 class="title-color font-sm"><i class="iconly-Location icli"></i>مسجد العز بن عبدالسلام</h3>
                        <p class="content-color font-sm">مكة المنصورة</p>
                    </div>
                </div>
            </div>
            <div class="d-grid gap-2 d-md-block mb-10">
                <a href="{{ route('products') }}" class="btn btn-primary btn-lg">اختر الكمية</a>
            </div>
        </section>



        <!-- Location Section End -->
    </main>
@endsection
@section('js')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBt1J8Sw2fZzmzKdBviTpL1biFzQv3-Ugg"
        type="text/javascript"></script>
    <script src="{{ url('') }}/assets/js/jquery.yogamap.js"></script>
    <script>
        $(function() {
            // if ("geolocation" in navigator) {
            //     navigator.geolocation.getCurrentPosition(function(position) {
            //         var longitude = position.coords.longitude;
            //         var latitude = position.coords.latitude;

            //     });

            // }
            $('.ini_class').yogamap({
                "height": "300px",
                "center": [21.547166, 39.1466905],
                "addmarkers": [{
                        "title": "Islamic Center Mosque",
                        "latlng": [21.547166,
                            39.1466905
                        ],
                        "icon": "{{ url('') }}/assets/pic/m_1_blue_s.png",
                        "contentstringAuto": true,
                        "address": '<div class="row"><div class="col-8  text-start"><p>District, City <br>Capacity: 1,725 Prayer</p></div><div class="col-4  text-center py-3"><a class="badges-round bg-theme-theme font-xs text-white" href="{{ route('products') }}">Select</a></div></div>'
                    },
                    {
                        "title": "Alhuda Mosque",
                        "latlng": [21.947166,
                            39.1466905
                        ],
                        "icon": "{{ url('') }}/assets/pic/m_1_blue_s.png",
                        "contentstringAuto": true,
                        "address": '<div class="row"><div class="col-8  text-start"><p>District, City <br>Capacity: 1,725 Prayer</p></div><div class="col-4  text-center py-3"><a class="badges-round bg-theme-theme font-xs text-white" href="{{ route('products') }}">Select</a></div></div>'
                    },
                    {
                        "title": "Othaman Mosque",
                        "latlng": [21.147166,
                            39.1466905
                        ],
                        "icon": "{{ url('') }}/assets/pic/m_1_blue_s.png",
                        "contentstringAuto": true,
                        "address": '<div class="row"><div class="col-8  text-start"><p>District, City <br>Capacity: 1,725 Prayer</p></div><div class="col-4  text-center py-3"><a class="badges-round bg-theme-theme font-xs text-white" href="{{ route('products') }}">Select</a></div></div>'
                    }
                ],
                // "scrollwheel": true,
                "clusterEnable": true,
                "customClusterEnable": true,
                "customCluster": [{
                    "height": 56,
                    "width": 56,
                    "url": "{{ url('') }}/assets/pic/c_7_blue_m.png",
                    "textColor": "#fff",
                    "textSize": 14
                }]
            });


        })
    </script>
@endsection
