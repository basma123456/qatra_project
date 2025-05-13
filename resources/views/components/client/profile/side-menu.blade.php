<div class="profile-side col-12 order-1 col-lg-3 my-4">
    <!--Menu-->
    <div class="rounded-3 bg-white mt-2 overflow-hidden">
        <div class="row">

            <div class="col-12 meun-li {{ Route::is('client.profile.index') ? 'active' : '' }}">
                <a href="{{ route('client.profile.index') }}">
                    <div class="d-flex align-items-center p-3">
                        <i class="bx bxs-user-account fs-4 mx-3"></i>
                        <h1 class="fs-4"> بيانات الحساب </h1>
                    </div>
                </a>
                <hr />
            </div>

            <div class="col-12 meun-li {{ Route::is('client.profile.orders') ? 'active' : '' }}">
                <a href="{{ route('client.profile.orders') }}">
                    <div class="d-flex align-items-center align-content-center p-3">
                        <i class="bx bx-list-ul fs-4 mx-3"></i>
                        <h1 class="fs-4"> طلباتي </h1>
                    </div>
                </a>
                <hr />
            </div>

            <div class="col-12 meun-li {{ Route::is('client.profile.favorite-mosque') ? 'active' : '' }}">
                <a href="{{ route('client.profile.favorite-mosque') }}">
                    <div class="d-flex align-items-center p-3">
                        <i class="bx bxs-heart fs-4 mx-3"></i>
                        <h1 class="fs-4"> المساجد المفضلة </h1>
                    </div>
                </a>
                <hr />
            </div>

            <div class="col-12 meun-li {{ Route::is('client.profile.notifications') ? 'active' : '' }}">
                <a href="{{ route('client.profile.notifications') }}">
                    <div class="d-flex align-items-center p-3">
                        <i class="bx bxs-bell-ring fs-4 mx-3"></i>
                        <h1 class="fs-4">خيارات الاشعارات</h1>
                    </div>
                </a>
                <hr />
            </div>


            {{-- @forelse($locals as $local)
            <div class="col-12 meun-li">
                <a href="{{ \LaravelLocalization::getLocalizedURL($local , \Request::fullUrl() ) }}">
                    <div class="d-flex align-items-center p-3">
                        <i class="bx bx-world fs-4 mx-3"></i>
                        <h1 class="fs-4">{{ strtoupper($local) }}</h1>
                    </div>
                </a>
                <hr />
            </div>
            @empty
            @endforelse --}}


            <div class="col-12 meun-li">
                <a href="{{ route('client.logout') }}">
                    <div class="d-flex align-items-center p-3">
                        <i class="bx bx-log-out fs-4 mx-3"></i>
                        <h1 class="fs-4">تسجيل خروج</h1>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!--Menu-->
</div>
