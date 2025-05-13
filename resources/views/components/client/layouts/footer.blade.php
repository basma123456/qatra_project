<div>
    <!--Whatsapp-->
    <a href="https://wa.me/{{ $settings->getItem('whatsapp') }}" target="_blank" class="whatsapp-icon" title="Contact us on WhatsApp">
        <i class="bx bxl-whatsapp"></i>
    </a>
    <!--Whatsapp-->

    <div class="Footer mt-5 p-5">
        <div class="container">
            <div class="row">
                <div class="fcol col-12 col-lg-4 text-center text-lg-end mb-3 mb-lg-0">
                    <h3 class="label p-2 mx-auto mx-lg-0">{{\App\Settings\SettingSingleton::getInstance()->getItem('site_name_ar')}}متجر </h3>
                    <p>
                        {{\App\Settings\SettingSingleton::getInstance()->getItem('footer_text_ar')}}
                    </p>
                </div>
                <div class="fcol col-12 col-lg-4 text-center text-lg-end mb-3 mb-lg-0">
                    <h3 class="import-links p-2 ">روابط مهمة</h3>
                    <ul>
                        @forelse ($menuItems??[] as $menuItem)
                            @if ($menuItem->type == App\Enums\MunesEnums::DYNAMIC)
                                <li> <a href="{{ App::make('url')->to($menuItem->dynamic_url) }}">{{ $menuItem->title }}</a> </li>

                            @elseif ($menuItem->type == App\Enums\MunesEnums::STATIC)
                                <li> <a href="{{ App::make('url')->to($menuItem->url) }}">{{ $menuItem->title }}</a></li>
                            @endif
                        @empty
                        @endforelse
                    </ul>
                </div>
                <div class="soical col-12 col-lg-4">
                    <h3 class="socail-links p-2 mx-auto">تواصل معانا</h3>
                    <ul class="text-center">
                        <li class="phone">
                            <a href="tel:{{ $settings->getItem('mobile') }}">
                                <img src="{{asset('client/img/whatsIcon.png')}}" alt="" />
                                <span class="me-3">{{\App\Settings\SettingSingleton::getInstance()->getItem('mobile')}}</span>
                            </a>

                        </li>
                        <li class="whatsapp">
                            <a href="https://wa.me/{{ $settings->getItem('whatsapp') }}">
                                <img src="{{asset('client/img/phoneIcon.png')}}" alt="" />
                                <span class="me-3">{{\App\Settings\SettingSingleton::getInstance()->getItem('whatsapp')}}</span>
                            </a>
                        </li>
                        <li class="email">
                            <a href="mail:{{ $settings->getItem('mobile') }}">
                                <img src="{{asset('client/img/emaiIcon.png')}}" alt="" />
                                <span class="me-1">{{\App\Settings\SettingSingleton::getInstance()->getItem('email')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--Footer-->
    <!--TopBar-->
    <div class="TopBar p-3">
        <div class="container">
            <div class="d-flex align-items-center justify-content-lg-between justify-content-center flex-wrap">
                <div class="text my-2">
                    <h4 class="ms-3">منصة {{\App\Settings\SettingSingleton::getInstance()->getItem('site_name_ar')}}  2024</h4>
                </div>
                <div class="soical my-2">
                    <a>
                        <img src="{{asset('client/img/tiktok.png')}}" onclick="window.open('{{\App\Settings\SettingSingleton::getInstance()->getItem('tiktok')}}' , '_blank')" alt="" />
                    </a>
                    <a>
                        <img src="{{asset('client/img/snapchat.png')}}" onclick="window.open('{{\App\Settings\SettingSingleton::getInstance()->getItem('snapchat')}}' , '_blank')" alt="" />
                    </a>
                    <a>
                        <img src="{{asset('client/img/instagram.png')}}" onclick="window.open('{{\App\Settings\SettingSingleton::getInstance()->getItem('instagram')}}' , '_blank')" alt="" />
                    </a>
                    <a>
                        <img src="{{asset('client/img/x.png')}}" onclick="window.open('{{\App\Settings\SettingSingleton::getInstance()->getItem('twitter')}}' , '_blank')" alt="" />
                    </a>
                    <span> {{\App\Settings\SettingSingleton::getInstance()->getItem('email')}} </span>
                </div>
                <div class="text-center">
                    <img src="{{asset('client/img/mada.png')}}" alt="" />
                    <img src="{{asset('client/img/appal.png')}}" alt="" />
                    <img src="{{asset('client/img/stc.png')}}" alt="" />
                    <img src="{{asset('client/img/visal.png')}}" alt="" />
                    <img src="{{asset('client/img/logo2.png')}}" alt="" />
                </div>
            </div>
        </div>
    </div>
    <!--TopBar-->
</div>
