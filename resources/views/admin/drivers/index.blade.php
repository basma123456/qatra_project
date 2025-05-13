@extends('admin.layout')

@section('title')
    إدارة السائقين
@endsection

@section('css')
@endsection

@section('breadcrumb')
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light"> نظام قطرة /</span><span class="text-muted fw-light">إدارة السائقين /</span> استعراض
        السائقين
    </h4>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-6 col-xl-3">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>السائقين المضافين</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">1</h4>
                            </div>
                            <small>سائق</small>
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
                            <span>الطلبات المسندة</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">2</h4>
                            </div>
                            <small>طلب</small>
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
                            <span>الطلبات غير المسندة</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">3</h4>
                            </div>
                            <small>طلب</small>
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
                            <span>الطلبات المنتهية</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">4</h4>
                            </div>
                            <small>طلب</small>
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
        <h5 class="card-header">استعراض السائقين</h5>
        <div class="row mx-2 mb-4">
            <div class="col-md-2">

            </div>
            <div class="col-md-10">
                <div
                    class="text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0">
                    <div class="dt-buttons">
                         <a href="{{ route('admin.driver.create') }}"
                            class="btn btn-primary ms-3"><span><i class="bx bx-plus me-0 me-lg-2"></i> إضافة سائق</span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>م</th>
                        <th>اسم السائق</th>
                        <th>الجوال</th>
                        <th>البريد الالكتروني</th>
                        {{-- <th>الحالة</th> --}}
                        <th>عمليات</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($drivers as $driver)
                        <tr>
                            <td>{{ $driver->id }}</td>
                            <td><strong>{{ $driver->name }}</strong></td>

                            <td>{{ $driver->mobile }}</td>
                            <td>{{ $driver->email }}</td>
                            {{-- <td>
                                <span
                                    class="badge {{ $driver->status()['badge'] }} me-1">{{ $driver->status()['title'] }}</span>
                            </td> --}}
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>





                                    <a href="{{ route('admin.driver.edit', $driver->id )}}" name="@lang('admin.edit')"  class="btn btn-xs btn-outline-primary btn-sm m-1"><i class="fa fa-edit"></i></a>

                                    <a href="{{ route('admin.driver.delete', $driver->id) }}" name="@lang('admin.delete')"  class="btn btn-xs btn-outline-danger btn-sm m-1"><i class="fa fa-trash"></i></a>



                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="min-height: 100px;">
                {{ $drivers->links() }}
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
                title: 'هل أنت متأكد ؟',
                text: "سوف يتم حذف العنصر المحدد",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'نعم احذف!',
                cancelButtonText: 'إلغاء',
                customClass: {
                    confirmButton: 'btn btn-primary me-3',
                    cancelButton: 'btn btn-label-secondary'
                },
                buttonsStyling: false
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
