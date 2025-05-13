<header id="page-topbar" >
    <div class="navbar-header">


        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box" style="background-color:{{ @$adminDashboardTheme->side_navbar_background }};">
                <a href="" class="logo logo-dark text-center" target="_blank">
                    <span class="logo-sm">
                        {{-- <img src="{{ asset('admin/assets/images/logo.png') }}" alt="" height="22"> --}}
                        <img src="{{ url('assets/images/logo/logo.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        {{-- <img src="{{ asset('admin/assets/images/logo-dark.png') }}" alt="" height="17"> --}}
                        <img src="{{ url('assets/images/logo/logo.png') }}" alt="" height="17">
                    </span>
                </a>

                <a href="" class="logo logo-light text-center" target="_blank">
                    <span class="logo-sm">
                        {{-- <img src="{{ asset('admin/assets/images/logo-light.png') }}" alt="" height="22"> --}}
                        <img src="{{ url('assets/images/logo/light_logo.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        {{-- <img src="{{ asset('admin/assets/images/logo-light.png') }}" alt="" height="36"> --}}
                        <img src="{{ url('assets/images/logo/light_logo.png') }}" alt="" height="36">

                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="mdi mdi-menu navbar-custom-color"></i>
            </button>

            <div class="d-none d-sm-block ms-2">
                <h4 class="page-title navbar-custom-color">@yield('title_page',  "لوحة التحكم")</h4>
            </div>
        </div>


        @if(auth()->guard('marketer_admin')->user())
        <div class="d-flex">



            <div class="dropdown d-none d-lg-inline-block me-2">
                <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                    <i class="mdi mdi-fullscreen navbar-custom-color"></i>
                </button>
            </div>

            <div class="dropdown d-none d-md-block me-2">
{{--                <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown"--}}
{{--                    aria-haspopup="true" aria-expanded="false">--}}
{{--                    <span class="font-size-16 navbar-custom-color"> @lang('admin.languages') </span> <img class="ms-2"--}}
{{--                        src="{{ asset('images/flags/'. app()->getLocale() .'_flag.jpg')}}" alt="Header Language" height="20">--}}
{{--                </button>--}}
                <div class="dropdown-menu dropdown-menu-end">

                </div>
            </div>

            <div class="dropdown d-inline-block me-2">
                <button type="button" class="btn header-item noti-icon waves-effect"
                    id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ion ion-md-notifications navbar-custom-color"></i>
                    <span class="badge bg-danger rounded-pill"> </span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="m-0 font-size-16">  تنبيهات ( 0 )

                                        <a href="#"> مشاهدة التنبيهات </a>

                                </h5>

                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">

                        <a href="#" class="text-reset notification-item">
                            <div class="d-flex">
                                <div class="avatar-xs me-3">
                                    <span class="avatar-title bg-success rounded-circle font-size-16">
                                        <i class="mdi mdi-email-outline"></i>
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <h6 class="mt-0 font-size-15 mb-1">

                                    </h6>

                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">

                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>




                    </div>
                    <div class="p-2 border-top">
                        <div class="d-grid">
                            <a class="btn btn-sm btn-link font-size-14  text-center"  href="#">
                               مشاهدة الكل
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{ asset('assets/images/avatar/default.png') }}"
                        alt="Header Avatar">
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="#" target="_blank"> @lang('admin.site')</a>
                    <a class="dropdown-item" href="#"> @lang('admin.profile')</a>

                    <a class="dropdown-item d-block" href="#">@lang('admin.settings')</a>
                    <div class="dropdown-divider"></div>

                    <!-- Authentication -->
                    <form method="get" action="{{ url('marketer_admin/logout')  }}">
                        @csrf
                        <a class="dropdown-item text-danger" href="#"
                            onclick="event.preventDefault();
                        this.closest('form').submit();">تسجيل الخروج</a>
                    </form>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                    <i class="mdi mdi-spin mdi-cog navbar-custom-color"></i>
                </button>
            </div>

        </div>
        @endif
    </div>
</header>
