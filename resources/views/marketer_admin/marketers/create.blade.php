@extends('marketer_admin.layout')

@section('title')
    إضافة مسوق
@endsection
@section('css')
@endsection
@section('breadcrumb')
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light"> نظام قطرة /</span><span class="text-muted fw-light">إدارة المسوقين /</span>
        إضافة مسوق
    </h4>
@endsection
@section('content')
    <div class="card mb-4">
        <h5 class="card-header">إضافة مسوق</h5>



        <form class="card-body" action="{{ route('marketer_admin.marketer.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-12">
                    <h4 class="mt-4 mb-0">معلومات عامة</h4>
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="collapsible-fullname">اسم المسوق</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="form-control @error('name') is-invalid @enderror" placeholder="اسم المسوق" />
                    @error('name')
                        <div class="invalid-feedback" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="collapsible-fullname">رقم الجوال</label>
                    <input type="number" name="mobile" value="{{ old('mobile') }}"
                        class="form-control @error('mobile') is-invalid @enderror" placeholder="9665XXXXXXXX" />
                    @error('mobile')
                        <div class="invalid-feedback" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="collapsible-fullname">البريد الالكتروني</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror" placeholder="البريد الالكتروني" />
                    @error('email')
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
