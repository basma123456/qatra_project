@extends('layouts.app')
@section('title')
@endsection
@section('css')
<style>
   .line200 {
            line-height: 200%;
        }
</style>
@endsection
@section('skeleton')
@endsection
@section('content')
    <main class="main-wrap mb-xxl">

        <!-- Login Section Start -->
        <section class="login-section p-0">
            <!-- Login Form Start -->
            <form action="{{ route("contactus") }}" method="POST" class="custom-form pb-5">
                @csrf
                <h1 class="font-md title-color fw-600 mb-3">تواصل معنا</h1>
                @include("front.messages")
                <p class="operationby  my-2 line200">
                    يمكنك التواصل معنا بتعبئة النموذج التالي وسنرد عليك خلال يوم عمل واحد.<br>
                    أو يمكنك إرسال رسالة على واتساب التالي 
                    <a href="https://wa.me/966551122267" target="_blank"><i class="ri-whatsapp-line"
                        style="color:#25D366;font-size:30px;"></i> 966551122267</a> 
                </p>
                <hr>
                <div class="input-box">
                    <label class="mt-2 mb-1">الاسم: </label>
                    <input type="text" placeholder="الاسم" class="form-control" name="name" value="{{ old("name") }}"  />
                </div>
                <div class="input-box">
                    <label class="mt-2 mb-1">الجوال: </label>
                    <input type="number" placeholder="9665XXXXXXXX" class="form-control" name="mobile" value="{{ old("mobile") }}"  />
                </div>
                <div class="input-box">
                    <label class="mt-2 mb-1">البريد الالكتروني: </label>
                    <input type="text" placeholder="البريد الالكتروني" class="form-control" name="email" value="{{ old("email") }}"  />
                </div>
                <div class="input-box">
                    <label class="mt-2 mb-1">موضوع الرسالة: </label>
                    <input type="text" placeholder="موضوع الرسالة" class="form-control" name="subject" value="{{ old("subject") }}"  />
                </div>
                <div class="input-box">
                    <label class="mt-2">تفاصيل الرسالة: </label>
                    <textarea placeholder="تفاصيل الرسالة" name="text" class="form-control">{{ old("text") }}</textarea>
                </div>



                <button type="submit" class="btn-solid mb-5">إرسال</button>

            </form>


        </section>

    </main>
@endsection
@section('js')
@endsection
