<!--Hero Section-->
<div class="Hero">
    <!-- Slider main container -->
    <div class="swiper banner">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            @forelse(\App\Models\Slider::active()->get() as $slider)
            <div class="swiper-slide">
                <div class="img_layer">
                    <img src="{{ $slider->pathInView() }}" class="img-fluid" alt="" />
                </div>
                <div class="text_layer">
                    <h1> {{$slider->title}} </h1>
                </div>
            </div>
            @empty
            @endforelse

        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>
    </div>
</div>
<!--Hero Section-->
