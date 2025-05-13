@extends('client.app')


@section('content')


@include('client.layouts.slider')

@forelse($cats as $key => $cat)

<!--Product Swiper-->
<div class="ProductSwiperHome mt-5">
    <div class="container">
        <div class="ProductsTitle mb-3 d-flex">
            <h2 class="mb-0 p-2">
                <a>{{$cat->name_ar}}</a>
            </h2>
            <button class="btn btn-more d-flex align-items-center">
                <span onclick="window.location.href='{{ route('client.products') . "?category=" . $cat->slug }}'">عرض الكل</span> <i class="bx bx-arrow-back mt-2"></i>
            </button>
        </div>
        <div class="swiper products_4 px-3">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                @forelse($cat->activeProducts as $product)
                <div class="swiper-slide">
                    <div class="swiper-slide">
                    @livewire('client.product-slider' , ['product' => $product ])
                    </div>
                </div>

                @empty
                @endforelse
            </div>
            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev products-prev_4 d-none d-lg-block"></div>
            <div class="swiper-button-next products-next_4 d-none d-lg-block"></div>
        </div>
    </div>
</div>
<!--Product Swiper-->
@empty
@endforelse

<!--Review-->
<div class="Review mt-5 p-3 text-center">
    <div class="container">
        <h5>اراء عملائنا</h5>

        <div class="swiper ReviewSlider">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper mt-3">
                <!-- Slides -->
                @forelse( \App\Models\Review::active()->feature()->orderBy('sort' , 'asc')->get() as $review)
                <!--Slide-->
                <div class="swiper-slide">
                    <div class="Reviewbox d-flex justify-content-center align-items-center p-3">
                        <img class="drop-img d-none d-lg-block" src="/img/drop.png" alt="" />
                        <img src="{{$review->pathInView()}}" class="img-fluid" alt="" />
                        <div class="ClinetInfo me-3">
                            <h4>{{$review->name}}</h4>
                            <p> {!! $review->description !!} </p>
                            @for($i=1; $i<=$review->rate; $i++)
                                <i class="bx bxs-star"></i>
                                @endfor
                        </div>
                    </div>
                </div>
                @empty
                @endforelse
            </div>
            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev reviews-prev d-none d-lg-block"></div>
            <div class="swiper-button-next reviews-next d-none d-lg-block"></div>
        </div>
    </div>
</div>
<!--Review-->



@foreach($ads as $key => $ad)

@if($key % 2 == 0)
<!--Ads-->
<div class="container">
    <div class="Ads row mt-5 p-0" style="background-color: {{$ad->bg_color == 'transparent' ? '' : $ad->bg_color}} !important">
        <div class="col-12 col-lg-6 p-0">
            <img src="{{asset($ad->pathInView())}}" class="img-fluid p-0 w-100" alt="" />
        </div>
        <div class="col-12 col-lg-6 Banner text-center p-5">
            <div class="Logo text-center">
                @if($ad->show_logo_status == 1)
                <img src="{{asset($ad->getLogo())}}" class="img-fluid" alt="" />
                @endif
                <h4>{{$ad->title}}</h4>
            </div>
            <p class="my-3">
                {!! $ad->description !!}
            </p>
            <a class="btn btn-order px-5 rounded-pill" target="_blank" href="{{$ad->link??'#'}}">اطلب
                الان</a>


        </div>
    </div>
</div>

@else
<div class="container">
    <div class="Ads-green row mt-5 p-0" style="background-color: {{$ad->bg_color == 'transparent' ? '' : $ad->bg_color}} !important">
        <div class="col-12 col-lg-6 px-0">
            <img src="{{asset($ad->pathInView())}}" class="img-fluid p-0 w-100" alt="" />
        </div>
        <div class="col-12 col-lg-6 Banner text-center p-5">
            <div class="Logo text-center">
                @if($ad->show_logo_status == 1)
                <img src="{{asset($ad->getLogo())}}" class="img-fluid" alt="" />
                @endif
                <h4>{{$ad->title}}</h4>
            </div>
            <p class="my-3">
                {!! $ad->description !!}
            </p>

            <a class="btn btn-order px-5 rounded-pill" target="_blank" href="{{$ad->link??'#'}}">اطلب
                الان</a>
        </div>
    </div>
</div>

@endif
@endforeach


@livewire('client.ads')



@endsection
