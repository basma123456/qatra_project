@extends('admin.layout')

@section('name_ar', trans('admin.users' ))
@section('name_ar_page', trans('admin.users' ))

@section('style')
{{-- @vite(['resources/assets/admin/css/data-tables.js']) --}}
@endsection
@section('content')

<div class="container-fluid">


    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body  search-group">
                    <div class="row">
                        <div class="col-md-12 text-end mb-2">
                            <a href="{{ route('admin.admins.create') }}" class="btn btn-outline-success btn-sm">اضافة</a>
                        </div>
                    </div>
                    {{-- Start Form search --}}
                    <form action="{{route('admin.admins.index')}}" method="get">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-3 mb-2">
                                <input type="test" value="{{ old('name', request()->input('name')) }}" name="name" placeholder="ابحث بالاسم" class="form-control">
                            </div>


                            <div class="col-md-3 mb-2">
                                <input type="text" value="{{ old('email', request()->input('email')) }}" name="email" placeholder="ابحث بالايميل" class="form-control">
                            </div>

                            <div class="col-md-3 mb-2">
                                <input type="test" value="{{ old('mobile', request()->input('mobile')) }}" name="mobile" placeholder="ابحث بالجوال" class="form-control">
                            </div>


                            {{-- <div class="col-md-3 mb-2">--}}
                            {{-- <select class="form-select" name="status" aria-label=".form-select-sm example">--}}
                            {{-- <option selected value=""> @lang('admin.status')  </option>--}}
                            {{-- <option--}}
                            {{-- value="1"{{ old('status', request()->input('status')) == 1? "selected":"" }}>@lang('admin.active') </option>--}}
                            {{-- <option--}}
                            {{-- value="0" {{ old('status', request()->input('status')) != 1 && old('status', request()->input('status')) != null? "selected":"" }}> @lang('admin.dis_active') </option>--}}
                            {{-- </select>--}}
                            {{-- </div>--}}

                            <div class="search-input col-md-2">
                                <button class="btn btn-primary btn-sm" type="submit"><i class="fas fa-search"> </i>
                                </button>
                                <a class="btn btn-success btn-sm" href="{{route('admin.admins.index')}}"><i class="refresh ion ion-md-refresh"></i></a>
                            </div>
                        </div>
                    </form>
                    {{-- End Form search --}}
                </div>


                <div class="card-body mt-0 pt-0">
                    <form id="update-pages" action="{{route('admin.admins.actions')}}" method="post">
                        @csrf
                    </form>
                    <div class="table-responsive">
                        <table id="main-datatable" class="table table-bordered  dt-responsive nowrap table-striped table-table-success table-hover" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                            <thead>
                                <tr class="bluck-actions" style="display: none" scope="row">
                                    <td colspan="8">
                                        <div class="col-md-12 mt-0 mb-0 text-center">
                                            {{-- <button form="update-pages" class="btn btn-success btn-sm" type="submit"--}}
                                            {{-- name="publish" value="1"><i class="fa fa-check"></i></button>--}}
                                            {{-- <button form="update-pages" class="btn btn-warning btn-sm" type="submit"--}}
                                            {{-- name="unpublish" value="1"><i class="fa fa-ban"></i></button>--}}
                                            <button form="update-pages" class="btn btn-danger btn-sm" type="submit" name="delete_all" value="1"><i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </td>

                                </tr>
                                <tr>
                                    <th style="width: 1px">
                                        <input form="update-pages" class="checkbox-check flat" type="checkbox" name="check-all" id="check-all">
                                    </th>
                                    <th>#</th>
                                    <th>الاسم</th>
                                    <th>الايميل</th>
                                    <th>الجوال</th>
                                    <th>تاريخ الاشاء</th>
                                    <th>تاريخ التعديل</th>
                                    <th>الاجرائات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $item)
                                @if($item)
                                <tr>
                                    <td>
                                        <input form="update-pages" class="checkbox-check" type="checkbox" name="record[{{$item->id}}]" value={{ $item->id }}>
                                    </td>
                                    <td>{{ $users->firstItem() + $key  }}</td>
                                    <td>
                                        {{ $item->name}}
                                    </td>
                                    <td>
                                        {{-- {{ substr(removeHTML($item->description_ar),0,30)   }}--}}
                                        {{ $item->email }}

                                    </td>
                                    <td>{{ $item->mobile }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            {{-- @if($item->status == 1)--}}
                                            {{-- <a href="{{ route('admin.admins.update-status', $item->id )}}"--}}
                                            {{-- name="@lang('admin.active')"--}}
                                            {{-- class="btn btn-xs btn-success btn-sm m-1"><i--}}
                                            {{-- class="fa fa-check"></i></a>--}}
                                            {{-- @else--}}
                                            {{-- <a href="{{ route('admin.admins.update-status', $item->id )}}"--}}
                                            {{-- name="@lang('admin.dis_active')"--}}
                                            {{-- class="btn btn-xs btn-outline-secondary btn-sm m-1"><i--}}
                                            {{-- class="fa fa-ban"></i></a>--}}
                                            {{-- @endif--}}

                                            {{-- @if($item->feature == 1)--}}
                                            {{-- <a href="{{ route('admin.admins.update-featured', $item->id )}}"--}}
                                            {{-- name="@lang('admin.feature')"--}}
                                            {{-- class="btn btn-xs btn-warning btn-sm m-1"><i--}}
                                            {{-- class="fa fa-star"></i></a>--}}
                                            {{-- @else--}}
                                            {{-- <a href="{{ route('admin.admins.update-featured', $item->id )}}"--}}
                                            {{-- name="@lang('admin.feature')"--}}
                                            {{-- class="btn btn-xs btn-outline-secondary btn-sm m-1"><i--}}
                                            {{-- class="fa fa-star"></i></a>--}}
                                            {{-- @endif--}}


                                            <a href="{{ route('admin.admins.show', $item->id) }}" name="@lang('admin.show')" class="btn btn-xs btn-outline-info btn-sm m-1"><i class="fas fa-eye"></i></a>


                                            <a href="{{ route('admin.admins.edit',$item->id) }}" name="@lang('admin.edit')" class="btn btn-outline-primary btn-sm m-1"><i class="fas fa-pencil-alt"></i></a>

                                            <a class="btn btn-outline-danger btn-sm m-1" name="@lang('admin.delete')" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item->id }}">
                                                <i class="fas fa-trash-alt"> </i>
                                            </a>

                                        </div>
                                    </td>


                                </tr>
                                @include('admin.admins.delete')
                                @endif

                                @endforeach

                            </tbody>


                        </table>
                    </div>


                    <div class="col-md-12 text-center">
                        {{ $users->links() }}
                    </div>

                    </form>
                </div>

            </div>

        </div>

    </div> <!-- container-fluid -->

    @endsection



    @section('script')
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
