@extends('marketer.layout')

@section('title')
لوحة الإدارة -    اعادة تعيين كلمة المرور
@endsection
@section('css')
@endsection
@section('content')

    <div class="row justify-content-center">

        <div class="col-md-4 mt-5">

            <div class="card">
                <div class="card-body mt-4">

                    <h4 class="mb-2">مرحبا بك في نظام التسويق  بقطرة</h4>
                    <p class="mb-4">  اعادة تعيين كلمة المرور      </p>

                    <form id="formAuthentication" class="mb-3" action="{{ route('marketer.reset_password_show_email_page_store') }}" method="POST">
                        @csrf
                        @include("marketer.messages")
                        <div class="mb-3">
                            <label for="email" class="form-label"> الايميل  </label>
                            <input type="text" class="form-control" id="email" name="email"
                                placeholder="ادخل اسم الايميل الخاص بك" autofocus />
                        </div>


                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" type="submit">  ارسال </button>
                        </div>
                    </form>
                    <a style="width: 60px !important;" class="btn w-25 text-center  btn-outline-orange d-grid w-100 btn" href="{{url('marketer/login')}}">       رجوع </a>


                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
@endsection
