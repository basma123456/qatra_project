@extends('client.app')


@section('content')

<!--Fovarite section-->
<div class="Fovarite">
    <div class="container bg-light mt-5 rounded-3">
        <div class="info row gx-2">
            <!--edit section -->
            <div class="col-12 order-2 col-lg-9 mx-auto">
                <div class="info px-lg-5 bg-white m-md-5 ">
                    <h1 class="col-12 fs-2 text-center mt-5 pt-2"> بيانات الحساب </h1>

                    <div class="profile"> 
                        <div class="info px-lg-5 bg-white m-md-5">
                            <form class="d-flex align-items-center  mx-2 personl_info mt-3 mb-5 px-1">
                                <i class="bx bxs-user-detail fs-2 mt-2"></i>
                                <p class="border-0 fs-3 m-2">
                                    {{ auth()->user()->name }}
                                </p>
                            </form>
                            <hr class="spater" />
                            <form class="d-flex align-items-center personl_info mt-2 mb-5 px-1">
                                <i class="bx bxs-envelope fs-2 mt-2"></i>
                                <p class="border-0 fs-3 m-2">
                                    {{ auth()->user()->email }}
                                </p>
                            </form>
                            <hr />

                            <a href="{{ route('client.profile.edit') }}" class="btn btn-save btn-sm text-center px-md-0 px-2 col-md-3 col-12 fs-5 my-3 mx-auto">
                                تعديل
                            </a>
                        </div>
                    </div>


                    <div class="numbers row py-2" dir="rtl">
                        <div class="numerOfdonamtion col-md-5 col-12 me-1 bg-main rounded-3 text-center">
                            <h1 class="fs-1 mt-3"> {{ $ordersCount }} </h1>
                            <p class="fs-4" dir="rtl"> @lang('Number of donates') </p>
                        </div>

                        <div class="col-1">
                            <!--extra div-->
                        </div>

                        <div class="totalAmount col-md-5 col-12 mt-3 mt-md-0 bg-main rounded-3 text-center">
                            <h1 class="fs-1 mt-3"> {{ $totalOrders }} </h1>
                            <p class="fs-4" dir="rtl"> @lang('Total Amount') </p>
                        </div>
                    </div>
                    <!--table section -->
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
