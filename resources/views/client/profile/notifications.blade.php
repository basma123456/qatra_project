@extends('client.app')


@section('content')

<!--Fovarite section-->
<div class="Notification">
    <div class="container bg-light mt-5 rounded-3">
        <div class="info row gx-2">

            <div class="col-12 order-2 col-lg-9 mx-auto">
                <div class="info row px-lg-5 bg-white m-md-5">
                    <h1 class="col-12 fs-2 text-center mt-5">خيارات الاشعارات</h1>

                    <form action="{{ route('client.profile.notifications.update') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12 d-flex flex-wrap justify-content-evenly align-items-center my-4 text-center text-lg-end">
                                <div class="icon rounded-2 p-2 text-center">
                                    <i class="bx bx-bell fs-3"></i>
                                </div>

                                <div class="p-3">
                                    <h5>استقبال إشعارات بخصوص طلباتي</h5>
                                </div>

                                <label class="toggle-switch">
                                    <input type="checkbox" name="order_notifications" @if($user->order_notifications == 1) checked @endif />
                                    <span class="slider"></span>
                                </label>
                            </div>

                            <div class="col-12 d-flex flex-wrap justify-content-evenly align-items-center my-4 text-center text-lg-end">
                                <div class="icon rounded-2 p-2 text-center">
                                    <i class="bx bx-bell fs-3"></i>
                                </div>

                                <div class="p-3 mx-5">
                                    <h5>استقبال عروض حصرية</h5>
                                </div>

                                <label class="toggle-switch">
                                    <input type="checkbox" name="promotion_notifications" @if($user->promotion_notifications == 1) checked @endif />
                                    <span class="slider"></span>
                                </label>
                            </div>

                            
                            <button type="submit" class="bg-main btn btn-save btn-sm text-center px-md-0 px-2 col-md-3 col-12 fs-5 my-3 mx-auto">
                                حفظ
                            </button>
                        </div>
                    </form>

                </div>
            </div>

            <!--edit section -->
            <x-client.profile.side-menu />
        </div>
        <!--Menu section-->
    </div>
</div>
<!--Fovarite section-->

@endsection
