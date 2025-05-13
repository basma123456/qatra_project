@extends('marketer_admin.layout')

@section('title')
لوحة الإدارة - تسجيل الدخول
@endsection
@section('css')
@endsection
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-4 mt-5">
            <div class="card">
                <div class="card-body mt-4">

                    <h4 class="mb-2">مرحبا بك في نظام التسويق  بقطرة</h4>
                    <p class="mb-4">الرجاء تسجيل الدخول </p>

                    <form id="formAuthentication" class="mb-3" action="{{ route('marketer_admin.login') }}" method="POST">
                        @csrf
                        @include("marketer_admin.messages")
                        <div class="mb-3">
                            <label for="email" class="form-label">اسم المستخدم</label>
                            <input type="text" class="form-control" id="email" name="email"
                                placeholder="ادخل اسم المستخدم الخاص بك" autofocus />
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">كلمة المرور</label>
                            </div>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control" name="password"
                                    placeholder="ادخل كلمة المرور" aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" type="submit">تسجيل الدخول</button>


                        </div>

                    </form>
                    <a class="btn w-25  btn-outline-orange d-grid w-100 btn" href="{{route('marketer_admin.reset_password_show_email_page')}}">  نسيت كلمة المرور</a>



                </div>

            </div>
        </div>
    </div>

@endsection
@section('js')
@endsection
