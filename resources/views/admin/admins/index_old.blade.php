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
                    <div class="dt-buttons"> <a href="{{ route('admin.user.create') }}"
                            class="btn btn-primary ms-3"><span><i class="bx bx-plus me-0 me-lg-2"></i> إضافة سائق</span></a>
                    </div>
                </div>
            </div>
        </div>


        <div class="table-responsive text-nowrap">

            <div class="card-body mt-0 pt-0">
{{--                <form id="update-pages" action="{{route('admin.user.actions')}}" method="post">--}}
{{--                    @csrf--}}
{{--                </form>--}}
                <table id="main-datatable" class="table table-bordered  dt-responsive nowrap table-striped table-table-success table-hover" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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
                <tr>
                    <td>qqqqq</td>
                    <td>qqqqq</td>

                    <td>qqqqq</td>
                    <td>qqqqq</td>
                    <td>qqqqq</td>
                </tr>
                <tr>
                    <td>qqqqq</td>
                    <td>qqqqq</td>

                    <td>qqqqq</td>
                    <td>qqqqq</td>
                    <td>qqqqq</td>
                </tr>
                <tr>
                    <td>qqqqq</td>
                    <td>qqqqq</td>

                    <td>qqqqq</td>
                    <td>qqqqq</td>
                    <td>qqqqq</td>
                </tr>

                @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td><strong>{{ $user->name }}</strong></td>

                            <td>{{ $user->mobile }}</td>
                            <td>{{ $user->email }}</td>
                            {{-- <td>
                                <span
                                    class="badge {{ $user->status()['badge'] }} me-1">{{ $user->status()['title'] }}</span>
                            </td> --}}
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('admin.user.edit', $user->id) }}"><i
                                                class="bx bx-edit-alt me-1"></i>
                                            تعديل</a>
                                        <a class="dropdown-item confirm-delete"
                                            href="{{ route('admin.user.delete', $user->id) }}"><i
                                                class="bx bx-trash me-1"></i>
                                            حذف</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>

            <div style="min-height: 100px;">
                {{ $users->links() }}
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
