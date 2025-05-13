@extends('client.app')

@section('style')
<link rel="stylesheet" href="{{asset('client/css/select2.css')}}" />
@endsection


@section('content')


@livewire('client.product-main-item' , ['product' => $product , 'mosques' => $mosques , 'districts' => $districts , 'cities' => $cities])

<!-- Loading message, initially hidden -->
<div id="loadingMessage" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: rgba(0,0,0,0.5); color: white; padding: 20px; border-radius: 5px;">
    <h3>يرجى الانتظار...</h3>
</div>

<br>
<br>
<br>

<hr class="my-3">

<!--Product details-->
<h2 class="text-center" id="products"> منتجات مشابهة </h2>
<!--Product Swiper-->
<div id="ProductSwiper" class="ProductSwiper mt-5">
    <div class="ProductSwiperHome container">
        <div class="swiper otherProducts px-1">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                @foreach($cat->activeProducts as $product)
                <div class="swiper-slide">

                @livewire('client.product-slider' , ['product' => $product ])
                </div>
                @endforeach
            </div>
            <!-- If we need pagination -->
        </div>
    </div>
</div>

@endsection


@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!--select2-->
<script src="{{asset('client/js/select2.js')}}"></script>

<script>
    $('.select2').select2();
</script>
@endsection
