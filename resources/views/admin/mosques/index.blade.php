@extends('admin.layout')

@section('title')
إدارة المساجد
@endsection

@section('css')
@endsection

@section('breadcrumb')
<h4 class="py-3 breadcrumb-wrapper mb-4">
    <span class="text-muted fw-light"> نظام قطرة /</span><span class="text-muted fw-light">إدارة المساجد /</span>
    استعراض
    المساجد
</h4>
@endsection

@section('content')
<div class="row mx-2 mb-4">
    <div class="col-md-2">

    </div>
    <div class="col-md-10">
        <div class="text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0">
            <div class="dt-buttons">
                <a href="{{ route('admin.mosque.create') }}" class="btn btn-primary ms-3"><span><i class="bx bx-plus me-0 me-lg-2"></i> إضافة مسجد</span></a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6 col-xl-3">
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span>المساجد المضافة</span>
                        <div class="d-flex align-items-end mt-2">
                            <h4 class="mb-0 me-2">{{ $mosques_count }}</h4>
                        </div>
                        <small>مسجد</small>
                    </div>
                    <span class="badge bg-label-primary rounded p-2">
                        <i class="bx bx-customize bx-sm"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span>عدد المدن</span>
                        <div class="d-flex align-items-end mt-2">
                            <h4 class="mb-0 me-2">{{ $cities->count() }}</h4>
                        </div>
                        <small>مدينة</small>
                    </div>
                    <span class="badge bg-label-primary rounded p-2">
                        <i class="bx bx-customize bx-sm"></i>
                        {{-- <i class="menu-icon tf-icons bx bx-customize"></i> --}}
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span>عدد الأحياء</span>
                        <div class="d-flex align-items-end mt-2">
                            <h4 class="mb-0 me-2">{{ $districts->count() }}</h4>
                        </div>
                        <small>حي</small>
                    </div>
                    <span class="badge bg-label-primary rounded p-2">
                        <i class="bx bx-user bx-sm"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-sm-6 col-xl-3">
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span>السعة الإجمالية</span>
                        <div class="d-flex align-items-end mt-2">
                            <h4 class="mb-0 me-2">{{ number_format($capacity) }}</h4>
                        </div>
                        <small>مصلي</small>
                    </div>
                    <span class="badge bg-label-primary rounded p-2">
                        <i class="bx bx-user bx-sm"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <h5 class="card-header">استعراض المساجد</h5>
    <form class="card-body" action="{{ route('admin.mosque.index') }}" method="POST">
        @csrf
        <div class="row mx-2 mb-4">
            <div class="col-md-2">
                <input type="text" name="name" value="{{ old('name', $request->name) }}" class="form-control" placeholder="اسم المسجد" />
                <label class="form-label">اسم المسجد</label>
            </div>
            <div class="col-md-2">
                <select name="city_id" class="form-select select2">
                    <option value="0">كل المدن</option>
                    @foreach ($cities as $city)
                    <option @if($request->city_id==$city->id) selected
                        @endif value="{{ $city->id }}">{{ $city->name_ar }}</option>
                    @endforeach
                </select>
                <label class="form-label">المدينة</label>
            </div>
            <div class="col-md-2">
                <select name="district_id" class="form-select select2">
                    <option value="0">كل الأحياء</option>
                    @foreach ($districts as $district)
                    <option @if($request->district_id==$district->id) selected
                        @endif value="{{ $district->id }}">{{ $district->name_ar }}</option>
                    @endforeach
                </select>
                <label class="form-label">الحي</label>
            </div>

            <div class="col-md-2">
                <select name="status" class="form-select">
                    <option @if($request->status==-1 ) selected @endif value="-1"> الحالة</option>
                    <option @if($request->status==0) selected @endif value="0"> غير نشط</option>
                    <option @if($request->status==1) selected @endif value="1"> نشط</option>

                </select>
                <label class="form-label">المدينة</label>
            </div>

            <div class="col-md-1">
                <button type="submit" class="btn btn-primary">بحث</button>
            </div>
            <div class="col-md-4">
                <p class="my-2">المساجد المعروضة في الصفحة : {{ $mosques->count() }}</p>
            </div>

        </div>

    </form>
    <div class="table-responsive text-nowrap">
        <form id="update-pages" action="{{route('admin.mosque.actions')}}" method="post">
            @csrf
        </form>

        <table class="table table-striped">
            <thead>
                <tr class="bluck-actions" style="display: none" scope="row">
                    <td colspan="8">
                        <div class="col-md-12 mt-0 mb-0 text-center">
                            <button form="update-pages" class="btn btn-success btn-sm" type="submit" name="publish" value="1"><i class="fa fa-check"></i></button>
                            <button form="update-pages" class="btn btn-warning btn-sm" type="submit" name="unpublish" value="1"><i class="fa fa-ban"></i></button>
                            <button form="update-pages" class="btn btn-danger btn-sm" type="submit" name="delete_all" value="1"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </td>

                </tr>

                <tr>
                    <th style="width: 1px">
                        <input form="update-pages" class="checkbox-check flat" type="checkbox" name="check-all" id="check-all">
                    </th>

                    <th>م</th>
                    <th>اسم المسجد</th>
                    <th>المدينة</th>
                    <th>الحي</th>
                    <th>السعة الإجمالية</th>
                    <th>الحالة</th>
                    <th>ممتلئ</th>
                    <th class="text-center">عمليات</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

                @foreach ($mosques as $key => $mosque )

                <tr>

                    <td>
                        <input form="update-pages" class="checkbox-check" type="checkbox" name="record[{{$mosque->id}}]" value={{ $mosque->id }}>
                    </td>


                    <td>{{ $key + 1  }}</td>
                    <td><strong>{{ $mosque->name }}</strong></td>
                    <td>{{ $mosque->city->name }}</td>
                    <td>
                        {{ $mosque->district->name }}
                    </td>
                    <td>{{ number_format(($mosque->rows * $mosque->row_length) / 0.4) }}</td>
                    <td><span style="color: black" class="badge {{ $mosque->status()['badge'] }} me-1 ">{{ $mosque->status()['title'] }}</span>
                    </td>
                    <td><span style="color: black" class="badge {{ $mosque->full()['badge'] }} me-1">{{ $mosque->full()['title'] }}</span>
                    </td>

                    <td>
                        <div class="d-flex justify-content-center">
                            @if($mosque->status == 1)
                            <a href="{{ route('admin.mosque.update-status', $mosque->id )}}" name="@lang('admin.active')" class="btn btn-xs btn-success btn-sm m-1"><i class="fa fa-check"></i></a>
                            @else
                            <a href="{{ route('admin.mosque.update-status', $mosque->id )}}" name="@lang('admin.dis_active')" class="btn btn-xs btn-outline-secondary btn-sm m-1"><i class="fa fa-ban"></i></a>
                            @endif

                            {{-- @if($mosque->feature == 1)--}}
                            {{-- <a href="{{ route('admin.mosque.update-featured', $mosque->id )}}" name="@lang('admin.feature')" class="btn btn-xs btn-warning btn-sm m-1"><i class="fa fa-star"></i></a>--}}
                            {{-- @else--}}
                            {{-- <a href="{{ route('admin.mosque.update-featured', $mosque->id )}}" name="@lang('admin.feature')" class="btn btn-xs btn-outline-secondary btn-sm m-1"><i class="fa fa-star"></i></a>--}}
                            {{-- @endif--}}


                            <a href="{{ route('admin.mosque.show', $mosque->id) }}" name="@lang('admin.show')" class="btn btn-xs btn-outline-info btn-sm m-1"><i class="fas fa-eye"></i></a>


                            <a href="{{ route('admin.mosque.edit',$mosque->id) }}" name="@lang('admin.edit')" class="btn btn-outline-primary btn-sm m-1"><i class="fas fa-pencil-alt"></i></a>

                            <a class="btn btn-outline-danger btn-sm m-1" name="@lang('admin.delete')" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $mosque->id }}">
                                <i class="fas fa-trash-alt"> </i>
                            </a>

                        </div>
                    </td>


                    {{-- <td class="text-dark">--}}
                    {{-- <div class="dropdown">--}}
                    {{-- <button type="button" class="btn p-0 dropdown-toggle hide-arrow"--}}
                    {{-- data-bs-toggle="dropdown"> here--}}
                    {{-- <i class="bx bx-dots-vertical-rounded"></i>--}}
                    {{-- </button>--}}
                    {{-- <div class="dropdown-menu">--}}
                    {{-- <a class="dropdown-item" href="{{ route('admin.mosque.edit', $mosque->id) }}"><i--}} {{--                                                class="bx bx-edit-alt me-1"></i>--}} {{--                                            تعديل</a>--}} {{--                                        <a class="dropdown-item confirm-delete"--}} {{--                                            href="{{ route('admin.mosque.delete', $mosque->id) }}">
                        <i--}} {{--                                                class="bx bx-trash me-1"></i>--}} {{--                                            حذف</a>--}} {{--                                    </div>--}} {{--                                </div>--}} {{--                            </td>--}} </tr>
                            @include('admin.mosques.delete')

                            @endforeach
            </tbody>
        </table>
        <div style="min-height: 100px;">
            {{ $mosques->links() }}
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(".confirm-delete").on("click", function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        Swal.fire({
            title: 'هل أنت متأكد ؟'
            , text: "سوف يتم حذف العنصر المحدد"
            , icon: 'warning'
            , showCancelButton: true
            , confirmButtonText: 'نعم احذف!'
            , cancelButtonText: 'إلغاء'
            , customClass: {
                confirmButton: 'btn btn-primary me-3'
                , cancelButton: 'btn btn-label-secondary'
            }
            , buttonsStyling: false
        }).then(function(result) {
            if (result.value) {
                window.location.href = url;
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                return false;
            }
        });

    });

</script>
@endsection
