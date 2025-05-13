<span class="vertical-menu side-navbar-custom-color" style="background-color:{{ @$adminDashboardTheme->side_navbar_background }};" @guest style="display: none; margin: auto" @endguest>

    <span data-simplebar class="h-100">

        <!--- Sidemenu -->
        <span id="sidebar-menu">
            <!-- Left Menu Start -->
            @auth('admin')
            <ul class="metismenu list-unstyled" id="side-menu">
                {{-- View  Dashboard --}}
                <li>
                    <a href="{{ route('admin.home') }}" class="waves-effect">
                        <i class="fa fa-home"></i>
                        <span> لوحة التحكم الرئيسية </span>
                    </a>
                </li>

                <!-------------- CMS ------------->
                <li>
                    <a href="javascript:void(0)" class="has-arrow waves-effect">
                        <i class="mdi mdi-spin mdi-cog "></i>
                        <span>النظام</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        {{-- Menu -------------------------------------------------------------- --}}
                        <li>
                            <a href="{{ route('admin.admin.index') }}" class="waves-effect">
                                <i class="mdi mdi-spin mdi-cog "></i>
                                <span data-i18n="القوائم">المستخدمون</span>
                            </a>
                        </li>
                        {{-- Pages -------------------------------------------------------------- --}}
                        <li>
                            <a href="{{ route('admin.roles.index') }}" class="waves-effect">
                                <i class="mdi mdi-spin mdi-cog "></i>
                                <span data-i18n="الفحات"> الصلاحيات</span>
                            </a>
                        </li>

                        {{-- Menu -------------------------------------------------------------- --}}
                        <li>
                            <a href="{{ route('admin.menus.index') }}" class="waves-effect">
                                <i class="mdi mdi-spin mdi-cog "></i>
                                <span data-i18n="القوائم">القوائم</span>
                            </a>
                        </li>
                        {{-- Pages -------------------------------------------------------------- --}}
                        <li>
                            <a href="{{ route('admin.pages.index') }}" class="waves-effect">
                                <i class="mdi mdi-spin mdi-cog "></i>
                                <span data-i18n="الفحات">الصفحات</span>
                            </a>
                        </li>
                        {{-- Slider -------------------------------------------------------------- --}}
                        <li>
                            <a href="{{ route('admin.slider.index') }}" class="waves-effect">
                                <i class="mdi mdi-spin mdi-cog "></i>
                                <span data-i18n="السلايدر">السلايدر</span>
                            </a>
                        </li>
                        {{-- Banars -------------------------------------------------------------- --}}
                        <li>
                            <a href="{{ route('admin.ads.index') }}" class="waves-effect">
                                <i class="mdi mdi-spin mdi-cog "></i>
                                <span data-i18n="البنرات">البنرات</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.reviews.index') }}" class="waves-effect">
                                <i class="mdi mdi-spin mdi-cog "></i>
                                <span data-i18n="اراء العملاء"> اراء العملاء </span>
        
                            </a>
                        </li>
                    </ul>
                </li>


                <li>
                    <a href="javascript:void(0)" class="has-arrow waves-effect">
                        <i class="mdi mdi-spin mdi-cog "></i>
                        <span>المنتجات و الاقسام</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('admin.categories.index') }}" class="waves-effect">
                                <i class="mdi mdi-spin mdi-cog "></i>
                                <span>الاقسام</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.products.index') }}" class="waves-effect">
                                <i class="mdi mdi-spin mdi-cog "></i>
                                <span>المنتجات</span>
                            </a>
                        </li>
                    </ul>
                </li>


                <li>
                    <a href="javascript:void(0)" class="has-arrow waves-effect">
                        <i class="mdi mdi-spin mdi-cog "></i>
                        <span> المناطق </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('admin.cities.index') }}" class="waves-effect">

                                <i class="mdi mdi-spin mdi-cog "></i>
                                <span data-i18n="المدن">المدن</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.districts.index') }}" class="waves-effect">

                                <i class="mdi mdi-spin mdi-cog "></i>
                                <span data-i18n="المناطق">المناطق</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.mosque.index') }}" class="waves-effect">

                                <i class="mdi mdi-spin mdi-cog "></i>
                                <span data-i18n="المساجد">المساجد</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('admin.orders.index') }}" class="waves-effect">
                        <i class="mdi mdi-spin mdi-cog "></i>
                        <span data-i18n="الطلبات">الطلبات</span>
                    </a>
                </li>


                <li>
                    <a href="{{ route('admin.transfer.index') }}" class="waves-effect">
                        <i class="mdi mdi-spin mdi-cog "></i>
                        <span data-i18n="التحويلات">التحويلات</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.orders.assign') }}" class="waves-effect">
                        <i class="mdi mdi-spin mdi-cog "></i>
                        <span data-i18n="إسناد الطلبات">إسناد الطلبات</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.driver.index') }}" class="waves-effect">
                        <i class="mdi mdi-spin mdi-cog "></i>
                        <span data-i18n="السائقين">السائقين</span>
                    </a>
                </li>


                <li>
                    <a href="javascript:void(0)" class="has-arrow waves-effect">
                        <i class="mdi mdi-spin mdi-cog "></i>
                        <span>التسويق</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('admin.marketer_admin.index') }}" class="waves-effect">
                                <i class="menu-icon tf-icons bx bx-left-arrow-alt"></i>
                                <span>مديرين التسويق</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.marketer.index') }}" class="waves-effect">
                                <i class="menu-icon tf-icons bx bx-left-arrow-alt"></i>
                                <span>المسوقين</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.coupon.index') }}" class="waves-effect">
                                <i class="menu-icon tf-icons bx bx-left-arrow-alt"></i>
                                <span>الكوبونات</span>
                            </a>
                        </li>


                    </ul>
                </li>



               <li>
                    <a href="javascript:void(0)" class="has-arrow waves-effect">
                        <i class="mdi mdi-spin mdi-cog "></i>
                        <span>الرسائل</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('admin.message.index') }}" class="waves-effect">
                                <i class="menu-icon tf-icons bx bx-left-arrow-alt"></i>
                                <span>رسائل في انتظار الموافقة</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.message.sent') }}" class="waves-effect">
                                <i class="menu-icon tf-icons bx bx-left-arrow-alt"></i>
                                <span>الرسائل المرسلة</span>
                            </a>
                        </li>

                    </ul>
                </li>
                
                <li>
                    <a href="javascript:void(0)" class="has-arrow waves-effect">
                        <i class="mdi mdi-spin mdi-cog "></i>
                        <span>تقارير</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                                                                        <li>
                            <a href="{{ route('admin.products_daily_income.reports.index') }}" class="waves-effect">
                                <i class="mdi mdi-spin mdi-cog "></i>
                                <span>الدخل اليومي للمنتجات</span>
                            </a>
                        </li>

                                                <li>
                            <a href="{{ route('admin.clients.reports.index') }}" class="waves-effect">
                                <i class="mdi mdi-spin mdi-cog "></i>
                                <span>العملاء</span>
                            </a>
                        </li>



                        <li>
                            <a href="{{ route('admin.reports.cities') }}" class="waves-effect">
                                <i class="mdi mdi-spin mdi-cog "></i>
                                <span>المدن</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.reports.products') }}" class="waves-effect">
                                <i class="mdi mdi-spin mdi-cog "></i>
                                <span>المنتجات</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.reports.visitors') }}" class="waves-effect">
                                <i class="mdi mdi-spin mdi-cog "></i>
                                <span>الزوار</span>
                            </a>
                        </li>
                    </ul>
                </li>

            

                {{-- @can('Super-Admin') --}}
                {{-- <li>
                    <a href="javascript:void(0)" class="has-arrow waves-effect">
                        <i class="mdi mdi-spin mdi-cog "></i>
                        <span> المديرين </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('admin.super_admins.index') }}" class="waves-effect">
                                <i class="mdi mdi-spin mdi-cog "></i>
                                <span>المديرين الرئيسيين </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.admins.index') }}" class="waves-effect">
                                <i class="mdi mdi-spin mdi-cog "></i>
                                <span> المديرين الفرعيين </span>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                {{-- @endcan --}}

                
                <li>
                    <a href="{{ route('admin.payment_methods.index') }}" class="waves-effect">
                        <i class="mdi mdi-spin mdi-cog "></i>
                        <span data-i18n="وسائل الدفع">وسائل الدفع</span>
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('admin.settings.index') }}" class="waves-effect">
                        <i class="mdi mdi-spin mdi-cog "></i>
                        <span data-i18n="الاعدادات"> الاعدادات </span>

                    </a>
                </li>



                <!----------------end old sidebar ---------------->


            </ul>
            @endauth


            {{-- </ul>--}}

            </div>
            <!-- Sidebar -->
            </div>
            </div>
