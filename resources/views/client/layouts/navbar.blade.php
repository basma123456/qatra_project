<!--TopBar-->
<div class="TopBar p-3 pb-0 d-none d-lg-block">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between flex-wrap">
            <div class="text d-flex">
                {{-- <h4 class="ms-3">سياسة الاستبدال والاسترجاع</h4>--}}
                {{-- <h4 class="ms-3">سياسة الاستخدام والخصوصية</h4>--}}
                {{-- <h4 class="ms-3">التوصيل داخل المملكة العربية السعودية</h4>--}}
                @foreach(\App\Settings\PagesSingleton::getInstance()->getPagesNames() as $key => $val )
                <h4 onclick="window.location.href='{{route('client.pages.show' , $val)}}'" class="ms-3 btn  fw-bold">{{$key}}</h4>
                @endforeach


            </div>
            <div class="search d-flex align-items-center d-none d-md-flex">
                <h4 class="ms-3">{{\App\Settings\SettingSingleton::getInstance()->getItem('email')}}</h4>
                <input class="form-control mb-2" type="search" placeholder="البحث" aria-label="Search" />
            </div>
        </div>
    </div>
</div>
<!--TopBar-->
<!--Navbar2-->
<nav class="navbar navCart navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="{{route('client.home')}}">
           {{-- <img src="{{asset('client/img/logo.png')}}" alt="" /> --}}
            <img src="{{$SiteSetting['logo']}}" alt="" />
        </a>
       
        @php
        $items = Cache::get('menus');
        if( $items == null){
        $items = Cache::rememberForever('menus', function () {
        return App\Models\Menue::orderBy('sort', 'ASC')->main()->active()->get();
        });
        }
        @endphp


        <div class="icons my-3 d-flex justify-content-center align-items-center d-lg-none">
            @livewire('client.total-num-of-items')
            <i class="bx bx-basket" onclick="window.location.href='{{route('client.cart.index')}}'"></i>

            <div class="login d-flex justify-content-center align-content-center me-3">
                <livewire:client.layout.user-icon />
            </div>
        </div>

        <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0">
                 @include('client.layouts.menu-item')
            </ul>
            <div class="icons d-none me-auto d-lg-flex justify-content-center align-items-center">
                @livewire('client.total-num-of-items')
                <i class="bx bx-basket" onclick="window.location.href='{{route('client.cart.index')}}'"></i>

                <div class="login d-flex justify-content-center align-content-center me-3">
                    <livewire:client.layout.user-icon />
                </div>
            </div>
        </div>
    </div>
</nav>
<!--Navabar-->
