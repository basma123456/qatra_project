@extends('admin.layout')

@section('title')
    إدارة الكوبونات
@endsection

@section('css')
    <style>
        .badge {
            text-transform: lowercase;
        }
    </style>
@endsection

@section('breadcrumb')
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light"> نظام قطرة /</span><span class="text-muted fw-light">إدارة الكوبونات /</span>
        استعراض
        الكوبونات
    </h4>
@endsection

@section('content')
    <div class="card">
        <h5 class="card-header">استعراض الكوبونات</h5>
        <div class="row mx-2 mb-4">
            <div class="col-md-2">
            </div>
            <div class="col-md-10">
                {{-- <div
                    class="text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0">
                    <div class="dt-buttons"> <a href="{{ route('admin.coupon.create') }}"
                            class="btn btn-primary ms-3"><span><i class="bx bx-plus me-0 me-lg-2"></i> إضافة مسوق</span></a>
                    </div>
                </div> --}}
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>م</th>
                        <th>اسم المسوق</th>
                        <th>الكوبون</th>
                        <th>المنتج</th>
                        <th>الكمية لكل 100 ريال</th>
                        <th>الحالة</th>
                        <th>عمليات</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($coupons as $coupon)
                        <tr>
                            <td>{{ $coupon->id }}</td>
                            <td><strong>{{ $coupon->marketer->name }}</strong></td>

                            <td>{{ $coupon->code }}</td>
                            <td>
                                @forelse ($coupon->products as $prod)
                                <span class="badge bg-secondary"> {{ $prod->name_ar }} </span>
                                @empty
                                    
                                @endforelse
                            </td>
                            <td>{{ $coupon->quantity }}</td>
                            <td>
                                <div
                                    class ="alert p-1 @if ($coupon->status) alert-success @else alert-danger @endif text-center">
                                    {{ $coupon->code }}</div>
                            </td>
                            <td>
                                @if ($coupon->status)
                                    <a class="btn btn-sm btn-danger" href="{{ route('admin.coupon.deactivate', $coupon) }}">
                                        <i class='bx bx-x'></i> إلغاء التفعيل
                                    </a>
                                @else
                                    <a class="btn btn-sm btn-success" href="{{ route('admin.coupon.activate', $coupon) }}">
                                        <i class='bx bx-check '></i> تفعيل
                                    </a>
                                @endif
                                <a class="btn btn-sm btn-danger" href="{{ route('admin.coupon.delete', $coupon) }}">
                                    <i class='bx bx-trash '></i> حذف
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="min-height: 100px;">
                {{ $coupons->links() }}
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
