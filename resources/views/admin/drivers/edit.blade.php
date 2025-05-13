@extends('admin.layout')

@section('title')
    تعديل سائق
@endsection
@section('css')
@endsection
@section('breadcrumb')
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light"> نظام قطرة /</span><span class="text-muted fw-light">إدارة السائقين /</span>
        تعديل سائق
    </h4>
@endsection
@section('content')
    <div class="card mb-4">
        <h5 class="card-header">تعديل سائق</h5>
        <form class="card-body" action="{{ route('admin.driver.edit',$driver->id) }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-12">
                    <h4 class="mt-4 mb-0">معلومات عامة</h4>
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="collapsible-fullname">اسم السائق</label>
                    <input type="text" name="name" value="{{ old('name',$driver->name) }}"
                        class="form-control @error('name') is-invalid @enderror" placeholder="اسم السائق" />
                    @error('name')
                        <div class="invalid-feedback" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="collapsible-fullname">رقم الجوال</label>
                    <input type="number" name="mobile" value="{{ old('mobile',$driver->mobile) }}"
                        class="form-control @error('mobile') is-invalid @enderror" placeholder="9665XXXXXXXX" />
                    @error('mobile')
                        <div class="invalid-feedback" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="collapsible-fullname">البريد الالكتروني</label>
                    <input type="email" name="email" value="{{ old('email',$driver->email) }}"
                        class="form-control @error('email') is-invalid @enderror" placeholder="البريد الالكتروني" />
                    @error('email')
                        <div class="invalid-feedback" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="collapsible-fullname">كلمة المرور</label>
                    <input type="password" name="password" value="{{ old('password',null) }}"
                        class="form-control @error('password') is-invalid @enderror" placeholder="كلمة المرور" />
                    @error('password')
                        <div class="invalid-feedback" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">حفظ</button>
                </div>

            </div>
        </form>
    </div>
@endsection
@section('js')
    <script>
        
    </script>
@endsection
