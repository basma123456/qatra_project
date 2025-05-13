@extends('admin.layout')

@section('title')
    {{$marketer_admin->name}}     عرض بيانات المسوق
@endsection
@section('css')
@endsection
@section('breadcrumb')
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light"> نظام قطرة /</span><span class="text-muted fw-light">إدارة المسوقين /</span>
             عرض بيانات المسوق
    </h4>
@endsection
@section('content')
    <div class="card mb-4">
        <h5 class="card-header">     عرض بيانات المسوق    {{$marketer_admin->name}}    </h5>
        <div class="card-body" >

            <div class="row g-3">
                <div class="col-md-12">
                    <h4 class="mt-4 mb-0">معلومات عامة</h4>
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="collapsible-fullname">اسم المسوق</label>
                    <input disabled  type="text" name="name" value="{{ old('name',$marketer_admin->name) }}"
                        class="form-control @error('name') is-invalid @enderror" placeholder="اسم المسوق" />
                    @error('name')
                        <div class="invalid-feedback" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="collapsible-fullname">رقم الجوال</label>
                    <input disabled  type="number" name="mobile" value="{{ old('mobile',$marketer_admin->mobile) }}"
                        class="form-control @error('mobile') is-invalid @enderror" placeholder="9665XXXXXXXX" />
                    @error('mobile')
                        <div class="invalid-feedback" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="collapsible-fullname">البريد الالكتروني</label>
                    <input disabled  type="email" name="email" value="{{ old('email',$marketer_admin->email) }}"
                        class="form-control @error('email') is-invalid @enderror" placeholder="البريد الالكتروني" />
                    @error('email')
                        <div class="invalid-feedback" role="alert">{{ $message }}</div>
                    @enderror
                </div>
{{--                <div class="col-md-12">--}}
{{--                    <button type="submit" class="btn btn-primary">حفظ</button>--}}
{{--                </div>--}}

            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>

    </script>
@endsection
