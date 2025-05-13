@extends('admin.layout')

@section('title')
    تعديل مسجد
@endsection
@section('css')
@endsection
@section('breadcrumb')
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light"> نظام قطرة /</span><span class="text-muted fw-light">إدارة المساجد /</span>
        تعديل مسجد

    </h4>
@endsection
@section('content')
    <div class="row mx-2 mb-4">
        <div class="col-md-2">

        </div>
        <div class="col-md-10">
            <div
                class="text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0">
                <div class="dt-buttons">
                    <a href="{{ route('admin.mosque.index') }}"
                       class="btn btn-primary ms-3"><span><i class="bx bx-plus me-0 me-lg-2"></i>    رجوع </span></a>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <h5 class="card-header">تعديل مسجد</h5>


        <form class="card-body" action="{{ route('admin.mosque.update',$mosque->id) }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-12">
                    <h4 class="mt-4 mb-0">معلومات عامة</h4>
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="collapsible-fullname">اسم المسجد - عربي</label>
                    <input type="text" name="name_ar" value="{{ old('name_ar',$mosque->name_ar) }}"
                           class="form-control @error('name_ar') is-invalid @enderror"
                           placeholder="اسم المسجد - عربي"/>
                    @error('name_ar')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="collapsible-fullname">اسم المسجد - English</label>
                    <input type="text" name="name_en" value="{{ old('name_en',$mosque->name_en) }}"
                           class="form-control @error('name_en') is-invalid @enderror"
                           placeholder="اسم المسجد - English"/>
                    @error('name_en')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="collapsible-state">المدينة</label>
                    <select name="city_id"
                            class="select2 form-select @error('city_id') is-invalid @enderror"
                            data-allow-clear="true">
                        <option value="">اختر المدينة</option>
                        @foreach ($cities as $city)
                            <option @if (old('city_id',$mosque->city_id) == $city->id) selected
                                    @endif value="{{ $city->id }}">
                                {{ $city->name }}</option>
                        @endforeach
                    </select>
                    @error('city_id')
                    <div class="is-invalid"></div>
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="collapsible-state">الحي</label>
                    <select name="district_id"
                            class="select2 form-select @error('district_id') is-invalid @enderror"
                            data-allow-clear="true">
                        <option value="">اختر الحي</option>
                        @foreach ($districts as $district)
                            <option
                                @if (old('district_id',$mosque->district_id) == $district->id) selected
                                @endif value="{{ $district->id }}">
                                {{ $district->name }}</option>
                        @endforeach
                    </select>
                    @error('district_id')
                    <div class="is-invalid"></div>
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
{{--                    <h4 class="mt-4 mb-0">الموقع الجغرافي</h4>--}}
                </div>
{{--                <div class="col-md-4">--}}
{{--                    <label class="form-label" for="collapsible-phone">خط الطول</label>--}}
{{--                    <input id="longitude" name="longitude" type="text"--}}
{{--                           value="{{ old('longitude',$mosque->longitude) }}"--}}
{{--                           class="form-control @error('longitude') is-invalid @enderror"--}}
{{--                           placeholder="خط الطول"/>--}}
{{--                    @error('longitude')--}}
{{--                    <div class="invalid-feedback">{{ $message }}</div>--}}
{{--                    @enderror--}}
{{--                </div>--}}
{{--                <div class="col-md-4">--}}
{{--                    <label class="form-label" for="collapsible-phone">خط العرض</label>--}}
{{--                    <input id="latitude" name="latitude" type="text"--}}
{{--                           value="{{ old('latitude',$mosque->latitude) }}"--}}
{{--                           class="form-control @error('latitude') is-invalid @enderror"--}}
{{--                           placeholder="خط العرض"/>--}}
{{--                    @error('latitude')--}}
{{--                    <div class="invalid-feedback">{{ $message }}</div>--}}
{{--                    @enderror--}}
{{--                </div>--}}
{{--                <div class="col-md-4">--}}
{{--                    <button type="button" class="btn btn-primary" id="get_location">احصل على الموقع--}}
{{--                        مباشرة--}}
{{--                    </button>--}}
{{--                </div>--}}
                <div class="col-md-12">
                    <h4 class="mt-4 mb-0">سعة المسجد</h4>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="collapsible-phone">عدد الصفوف</label>
                    <input name="rows" type="text" value="{{ old('rows',$mosque->rows) }}"
                           class="form-control @error('rows') is-invalid @enderror"
                           placeholder="عدد الصفوف"/>
                    @error('rows')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="collapsible-phone">طول الصف</label>
                    <input name="row_length" type="text"
                           value="{{ old('row_length',$mosque->row_length) }}"
                           class="form-control @error('row_length') is-invalid @enderror"
                           placeholder="طول الصف"/>
                    @error('row_length')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <h4 class="mt-4 mb-0">حالة المسجد</h4>
                </div>
                <div class="col-md-12">
                    <label class="switch switch-primary">
                        <input type="checkbox" class="switch-input" name="status"
                               @if($mosque->status==1) checked @endif value="1"/>
                        <span class="switch-toggle-slider">
                            <span class="switch-on"></span>
                            <span class="switch-off"></span>
                        </span>
                        <span class="switch-label">حالة العرض</span>
                    </label>
                </div>
                <div class="col-md-12">
                    <h4 class="mt-4 mb-0">حالة الامتلاء</h4>
                </div>


                <div class="col-md-12">
                    <label class="switch switch-primary">
                        <input type="checkbox" class="switch-input" name="is_full"
                               @if($mosque->is_full==1) checked @endif value="1"/>
                        <span class="switch-toggle-slider">
                            <span class="switch-on"></span>
                            <span class="switch-off"></span>
                        </span>
                        <span class="switch-label">ممتلئ</span>
                    </label>
                </div>


                <div class="col-md-12">
                    <label class="switch switch-primary">
                        <input type="checkbox" class="switch-input" name="high_need"
                               @if($mosque->high_need==1) checked @endif value="1"/>
                        <span class="switch-toggle-slider">
                            <span class="switch-on"></span>
                            <span class="switch-off"></span>
                        </span>
                        <span class="switch-label">اكثر احتياجا</span>
                    </label>
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">حفظ</button>
                </div>

            </div>
        </form>
    </div>
@endsection


@section('js')

@endsection
