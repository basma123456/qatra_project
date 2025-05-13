@extends('client.app')


@section('content')

<!--Fovarite section-->
<div class="Fovarite">
    <div class="container bg-light mt-5 rounded-3">
        <div class="info row gx-2">

            <div class="col-12 order-2 col-lg-9 mx-auto">
                <div class="info row px-lg-5 bg-white m-md-5">
                    <h1 class="col-12 fs-2 text-center mt-5"> تعديل بيانات الحساب </h1>

                    <form action="{{ route('client.profile.update') }}" method="POST">
                        @csrf
                        <div class="profile">
                            <div class="info row px-lg-5 bg-white m-md-5">
                                <div class="d-flex align-items-center personl_info mt-3 mb-5 px-0">
                                    <i class="bx bxs-user-detail fs-2 mt-2"></i>
                                    <input type="text" class="border-0 fs-3" name="name" value="{{ auth()->user()->name }}" dir="rtl" />
                                </div>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror 
                                <hr class="spater" />

                                <div class="d-flex align-items-center personl_info mt-2 mb-5 px-0">
                                    <i class="bx bxs-envelope fs-2 mt-2"></i>
                                    <input type="text" class="border-0 fs-3" name="email" value="{{ auth()->user()->email }}" dir="rtl" />
                                </div>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror 
                                <hr />

                                <button type="submit" class="btn btn-save btn-sm text-center px-md-0 px-2 col-md-3 col-12 fs-5 my-3 mx-auto">
                                    حفظ
                                </button>
                            </div>
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
