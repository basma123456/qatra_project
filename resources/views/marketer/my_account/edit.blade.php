@extends('marketer.layout')

@section('title')
    تعديل حسابي
@endsection
@section('css')
@endsection
@section('breadcrumb')
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light"> نظام قطرة /</span><span class="text-muted fw-light">إدارة الحسابيين /</span>
        تعديل حسابي
    </h4>
@endsection
@section('content')


    <div class="card mb-4">

        <h5 class="card-header">تعديل حسابي</h5>



        <form class="card-body" action="{{ route('marketer.my_account.update') }}" method="POST">
            @csrf
            @method('put')
            <div class="row g-3">
                <div class="col-md-12">
                    <h4 class="mt-4 mb-0">معلومات عامة</h4>
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="collapsible-fullname">اسم الحسابي</label>
                    <input type="text" name="name" value="{{ old('name',$marketer->name) }}"
                           class="form-control @error('name') is-invalid @enderror" placeholder="اسم الحسابي"/>
                    @error('name')
                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="collapsible-fullname">رقم الجوال</label>
                    <input type="number" name="mobile" value="{{ old('mobile',$marketer->mobile) }}"
                           class="form-control @error('mobile') is-invalid @enderror" placeholder="9665XXXXXXXX"/>
                    @error('mobile')
                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="collapsible-fullname">البريد الالكتروني</label>
                    <input type="email" name="email" value="{{ old('email',$marketer->email) }}"
                           class="form-control @error('email') is-invalid @enderror" placeholder="البريد الالكتروني"/>
                    @error('email')
                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                    @enderror
                </div>






                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">حفظ</button>
                </div>

            </div>
        </form>


        <!-- The Modal -->



        @endsection
        @section('js')
            <script>

            </script>
@endsection
