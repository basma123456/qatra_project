@extends('layouts.app')
@section('title')
    معلومات حسابي
@endsection
@section('css')
@endsection
@section('skeleton')
@endsection
@section('back_url',route("user.account"))
@section('content')
    <main class="main-wrap setting-page mb-xxl">
        <div class="user-panel">
            <div class="media">
                <div class="avatar-wrap">
                    <a href="javascript:void(0)"> <img src="{{ url('') }}/assets/images/avatar/avatar.jpg"
                            alt="avatar" /></a>
                    <span class="edit"> <i data-feather="edit-3"></i></span>
                </div>
                <div class="media-body">
                    <h2 class="title-color"></h2>
                    <span class="content-color font-md">{{ $user->mobile }}</span>
                </div>
            </div>
        </div>

        <!-- Form Section Start -->
        @include('front.messages')
        <form class="custom-form" action="{{ route('user.profile') }}" method="POST">
            @csrf
            <div class="input-box">
                <i class="ri-smartphone-line icli"></i>
                <input type="number" placeholder="{{ $user->mobile }}" name="mobile"
                    value="{{ old('mobile', $user->mobile) }}" class="form-control" readonly />
            </div>
            
            <div class="input-box">
                <i class="ri-user-3-line icli"></i>
                <input type="text" placeholder="{{ is_null($user->name) ? 'الاسم كاملاً (مطلوب)' : $user->name }}" name="name"
                    value="{{ old('name', $user->name) }}" class="form-control" required />
            </div>

            <div class="input-box">
                <i class="ri-at-line"></i>
                <input type="email" placeholder="{{ is_null($user->email) ? 'البريد الالكتروني (اختياري)' : $user->email  }}" name="email"
                    value="{{ old('email', $user->email) }}" class="form-control" required />
            </div>

            

            {{-- <div class="input-box">
                <i class="ri-calendar-line icli"></i>
                <input class="datepicker-here form-control digits" name="name" value="{{ old('name', $user->name) }}" type="text" autocomplete="off" data-language="en"
                    data-multiple-dates-separator=", " placeholder="28/12/1990" />
            </div> --}}
            <button type="submit" class="btn-solid disableafterclick">حفظ</button>
        </form>


    </main>
@endsection
@section('js')
@endsection
