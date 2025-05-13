<span class="vertical-menu side-navbar-custom-color"
      style="background-color:{{ @$adminDashboardTheme->side_navbar_background }}; background-color: #0b3e6f; color:white;"
      @guest style="display: none; margin: auto" @endguest >

    <span data-simplebar class="h-100">
{{--\App\Settings\MarketersSingleton::getInstance()->getMarketersByMarketerAdmin(auth()->guard('marketer_admin')->id())--}}
<!--- Sidemenu -->
        <span id="sidebar-menu">
            <!-- Left Menu Start -->
            @if(auth()->guard('marketer_admin')->check())
                <ul class="metismenu list-unstyled" id="side-menu">
                {{-- View  Dashboard --}}
                <li>
                    <a href="{{ url('/marketer_admin/dashboard') }}" class="waves-effect">
                        <i class="fa fa-home"></i>
                        <span> لوحة التحكم لادارة التسويق </span>
                    </a>
                </li>

                    <!-------------- CMS ------------->

                <li>
                    <a href="{{url('marketer_admin/my-account')}}" class="waves-effect">
                        <i class="mdi mdi-spin mdi-cog "></i>
                        <span data-i18n="حسابي">حسابي</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('marketer_admin.show_my_marketers')}}" class="waves-effect">
                        <i class="mdi mdi-spin mdi-cog "></i>
                        <span data-i18n="المسوقين">المسوقين</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/marketer_admin/orders') }}" class="waves-effect">
                        <i class="fa fa-home"></i>
                        <span> الطلبات </span>
                    </a>
                </li>


                    <!----------------end old sidebar ---------------->
            </ul>
                @endif


                {{-- </ul>--}}

                </div>
                <!-- Sidebar -->
                </div>
                </div>
