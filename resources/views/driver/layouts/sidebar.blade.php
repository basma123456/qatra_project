<span class="vertical-menu side-navbar-custom-color" style="background-color:{{ @$adminDashboardTheme->side_navbar_background }}; background-color: #263238; color:white;" @guest style="display: none; margin: auto" @endguest>

    <span data-simplebar class="h-100">
        {{--\App\Settings\MarketersSingleton::getInstance()->getMarketersByMarketerAdmin(auth()->guard('marketer_admin')->id())--}}
        <!--- Sidemenu -->
        <span id="sidebar-menu">
            <!-- Left Menu Start -->
            @if(auth()->guard('driver')->check())
            <ul class="metismenu list-unstyled" id="side-menu">
                {{-- View  Dashboard --}}
                <li>
                    <a href="{{ route('drivers.home') }}" class="waves-effect">
                        <i class="fa fa-home"></i>
                        <span> لوحة التحكم </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('drivers.delivery.index') }}" class="waves-effect">
                        <i class="mdi mdi-spin mdi-cog "></i>
                        <span data-i18n="طلبات التوصيل">طلبات التوصيل</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('drivers.mosque.index') }}" class="waves-effect">

                        <i class="mdi mdi-spin mdi-cog "></i>
                        <span data-i18n="المساجد">المساجد</span>
                    </a>
                </li>



            </ul>
            @endif


            {{-- </ul>--}}

            </div>
            <!-- Sidebar -->
            </div>
            </div>
