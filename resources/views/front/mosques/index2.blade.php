@extends('layouts.app')

@section('css')
    {{-- <link rel="stylesheet" href="{{ url('') }}/assets/css/yogamap.css?v={{ time() }}"> --}}
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
    />
    <style>
        .ini_class {
            min-height: 250px;
        }

        .gm-style .gm-style-iw-c {
            /* max-width: 100% !important; */
            margin: 0 !important;
            padding: 0 !important;    
        }
        .gm-style-iw-d{
            overflow:hidden !important;
        }
        .gm-style{
            font-family: "SSTArabic", "sans-serif";
        }
        #popup-image{
            max-width: 100%;
            max-height: 100%;
            border-radius: 10px;
            /* height: auto; */
        }
        .swiper {
            width: 230px;
            max-width: 100%;
            height: 180px;
        }
        /* .gm-style-iw-d{
            overflow: hidden;
        } */
        /* .gm-style-iw-d{
            padding: 0 !important;
            margin: 0 !important;
        } */
        /* #map {
        display: block;
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
        -webkit-box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.75);
        -moz-box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.75);
        box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.75);
        border-radius: 4px;
      } */
      .img_mosque{
		width: 240px;
        max-width: 100%;
		height: 150px;
		overflow: hidden;
		border-radius: 10px;
		margin-bottom: 10px;
		background-size: cover;
		background-position:center;
		background-repeat:no-repeat;
        cursor: pointer;
	  }
      /* .swiper-pagination-bullet{
        background: #fff !important;
      }
      .swiper-pagination-bullet-active{
        border: 1px solid #000 !important;
      } */
      #popup {
				position: fixed;
				top: 0;
				bottom: 0;
				left: 0;
				right: 0;
				margin: auto;
				display: block;
				width: 70%;
                height: 70%;
				padding: 5px;
				border-radius: 10px;
				-webkit-box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.75);
				-moz-box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.75);
				box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.75);
				transition: all 0.3s ease-in-out;
				-webkit-transition: all 0.3s ease-in-out;
				visibility: hidden;
				opacity: 0;
				z-index: 99999;
				background-color: #ffffff;
				text-align: center;
				background-repeat: no-repeat;
				background-position: center;
				background-size: contain;
			}
			#popup .close {
				display: block;
				/* width: 30px;
				height: 30px; */
				position: absolute;
				top: -25px;
				right: -25px;
				color: red;
				font-size: 18px;
				cursor: pointer;
                background: #fff;
                border: 1px solid #555;
                border-radius: 100%;
                padding: 1px 10px 5px 10px;
			}
			#popup img {
				height: auto;
				width: 100%;
			}
            /* .swiper-slide img {
				cursor: pointer;
			} */
    </style>
@endsection
@section('skeleton')
@endsection
@section('back_url',route("front.home"))
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
            </div>
        </section>
        <div id="popup">
			<div onclick="closeImage()" class="close">&#10006;</div>
			<img id="popup-image" src="" />
		</div>
        <div class="ini_class" id="ini_class">
            <div class="p-5 m-5 text-center">
                <div class="spinner-border" role="status">
                    <span class="sr-only"></span>
                </div>
            </div>
            {{-- <div class="map-holder">
                <div id="map"></div>
            </div> --}}
        </div>
        <!-- Map End -->

        <!-- Location Section Start -->
        <section class="location-section">
            <!-- Search Box Start -->
            <div class="search-box">
                <i class="iconly-Search icli search" id="btn_search"></i>
                <input class="form-control" id="search_mosque" type="search" placeholder="ابحث عن مسجد..." />
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

                <div class="location mb-5">
                    @if ($favorites->count() > 0)
                        @foreach ($favorites as $mosque)
                            <div class="location-box">
                                <a href="{{ route('front.products', $mosque->id) }}">
                                    <h3 class="title-color font-sm"><i class="iconly-Location icli"></i>{{ $mosque->name }}
                                    </h3>
                                </a>
                                <p class="content-color font-sm">{{ $mosque->city->name }} - {{ $mosque->district->name }}
                                </p>
                            </div>
                        @endforeach
                    @else
                        <div class="row">
                            <div class="col-12 text-center my-3">
                                <img src="{{ url('/assets/images/empty.png') }}" class="" style="width: 50px" />
                            </div>
                            <div class="col-12 text-center">
                                <p class="content-color">لم تقم بإضافة أي مسجد لقائمة المفضلة
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            {{-- <div class="d-grid gap-2 d-md-block mb-10">
                <a href="{{ route('front.products',1) }}" class="btn btn-primary btn-lg">اختر الكمية</a>
            </div> --}}
        </section>



        <!-- Location Section End -->
    </main>
    {{-- <div class="row">
        <div class="col-8">
            <p>{{ $mosque->city->name }} - {{ $mosque->district->name }}<br>السعة: {{ number_format($mosque->capacity) }} مصلي</p>
        </div>
        <div class="col-4">
            <a href='{{ route("front.products",$mosque->id) }}'></a>
        </div>
    </div> --}}
@endsection
@section('js')
    <script src="{{ url('') }}/assets/js/jquery-1.11.1.min.js"></script>
    <script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    {{-- <script src="{{ url('') }}/assets/js/jquery.yogamap.js"></script> --}}
    
    <script>
       
        function initMap() {
        const map = new google.maps.Map(document.getElementById("ini_class"), {
          zoom: 9,
          center: { lat: 21.42251, lng: 39.826168 },
          zoomControl: true,
            mapTypeControl: false,
            scaleControl: false,
            streetViewControl: false,
            rotateControl: false,
            fullscreenControl: true
        });
        const infoWindow = new google.maps.InfoWindow({
          content: "",
          disableAutoPan: true,
        });
        var locations = [];
        $.getJSON("{{ url('mosques/json') }}", function (points) {
          locations = points;
          const markers = locations.map((position, i) => {
            const lat = position.lat;
            const image = "{{ url('') }}/assets/pic/m_1_blue_s.png";
            const lng = position.lng;
            const jsonurl = position.jsonurl;
            const marker = new google.maps.Marker({
              position: new google.maps.LatLng(lat, lng),
              jsonurl: jsonurl,
              icon: image,
            });
            marker.addListener("click", () => {
              //   console.log(marker.jsonurl);
              //   map.setCenter(marker.getPosition());
              fetch(marker.jsonurl)
                .then(function (res) {
                  return res.json();
                })
                .then(function (data) {
					var html_imgs ="";
					data.imgs.forEach(function (element){
						html_imgs +=`<div class="swiper-slide">
													<div class="img_mosque"  onclick="openImage('${element}')" style="background-image: url('${element}');">
													</div>
												</div>`;
					});
                  infoWindow.setContent(
                    `<div style="display:block; width:230px; height:auto; padding:15px"><div class="row"><div class="col-12  text-center"><h2>${data.title}</h2><hr class="my-2"></div><div class="col-12 text-center"><div class="swiper" dir="rtl"><div class="swiper-wrapper">${html_imgs}</div><div class="swiper-pagination"></div></div></div><div class="col-8  text-start"><p>${data.address}</p></div><div class="col-4 text-center"><a class="badges-round bg-theme-theme font-xs text-white" href="${data.link}">اختر</a></div></div></div>`
                  );
				  const swiper = new Swiper(".swiper", {
						direction: "horizontal",
						loop: true,
						slideToClickedSlide: true,
						pagination: {
							el: ".swiper-pagination",
							clickable: true,
						},
					});
                  infoWindow.open(map, marker);
				  
                    setTimeout(() => {
                  					const swiper = new Swiper(".swiper", {
                  						direction: "horizontal",
                  						loop: true,
                  						slideToClickedSlide: true,
                  						pagination: {
                  							el: ".swiper-pagination",
                  							clickable: true,
                  						},
                  					});
                  				}, 500);
                });
            });
            return marker;
          });
          const cluster = new markerClusterer.MarkerClusterer({
            markers,
            map,
          });
        });
      }
      window.initMap = initMap;
        function closeImage() {
            let popup = document.getElementById("popup");
            popup.style.visibility = "hidden";
            popup.style.opacity = 0;
        }
        function openImage(img) {
            let popup = document.getElementById("popup");
            let popupImage = document.getElementById("popup-image");
            popupImage.setAttribute("src", img);
            popup.style.visibility = "visible";
            popup.style.opacity = 1;
            //popup.style.backgroundImage = `url('${img}')`;
        }
        $('#btn_search').click(function() {
            var search_mosque = $("#search_mosque").val();
            var url = '{{ secure_url("mosques/search") }}/'+search_mosque;
            $(".current-box").load(url);
        });


        gtag('event', 'map_view', {
        'screen_name': 'استعراض المساجد'
        });    
        
        

    </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBt1J8Sw2fZzmzKdBviTpL1biFzQv3-Ugg&callback=initMap&v=weekly"
        type="text/javascript"></script>

@endsection
