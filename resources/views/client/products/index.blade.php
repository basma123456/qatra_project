@extends('client.app')


@section('content')

    @include('client.layouts.slider')
    <br>
    @if(request()->get('category') )
        <h2 class="text-center" id="products"> منتجات
            قسم {{\App\Models\Category::where('slug' , request()->get('category'))->value('name_ar')??'' }}</h2>
    @else
        <h2 class="text-center" id="products"> منتجات </h2>
    @endif
    @forelse($products->chunk(\App\Settings\SettingSingleton::getInstance()->getItem('number_products_in_each_slider_categories')??2) as $chunk)

        <!--Product Swiper-->
        <div id="ProductSwiper" class="ProductSwiper mt-5">
            <div class="ProductSwiperHome container">
                <div class="swiper products px-1">
                    <div class="swiper-wrapper">
                        @foreach($chunk as $product)  {{-- Iterate through the products in the chunk --}}
                        @isset($product->slug)
                            <div class="swiper-slide">
                                @livewire('client.product-slider' , ['product' => $product ])
                            </div>
                        @endisset
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @empty
    @endforelse

@endsection
