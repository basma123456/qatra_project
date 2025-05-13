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

                    <form id="formAuthentication" class="mb-3" action="{{ route('marketer.reset_password.store') }}" method="POST">
                        @csrf
                        @include("marketer.messages")
                        <div class="mb-3">
                            <label for="text" class="form-label">  ادخل كلمة المرور الجديدة  </label>
                            <input type="password" class="form-control" id="password" name="password"
                                   placeholder=" ادخل كلمة المرور الجديدة .... "   />
                            <input type="hidden" name="email" value="{{$email}}">
                        </div>


                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" type="submit">  تأكيد </button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
@endsection
