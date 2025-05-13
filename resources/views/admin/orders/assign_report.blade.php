@extends('admin.layout')

@section('title')
    تقرير الطلبات المسندة
@endsection

@section('css')
@endsection

@section('breadcrumb')
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light"> نظام قطرة /</span><span class="text-muted fw-light">إدارة الطلبات /</span> تقرير
        الطلبات المسندة

    </h4>
@endsection

@section('content')
    <div class="card mt-4">
        <h5 class="card-header">إسناد الطلبات</h5>
        <form class="card-body" action="{{ route('admin.order.assign') }}" method="POST" id="form_assign">
            @csrf


            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>رقم الطلب</th>
                            <th>اسم المسجد</th>
                            <th>الحي</th>
                            <th>
                                <div class="row">
                                    <div class="col-9">
                                        المنتج
                                    </div>
                                    <div class="col-3">
                                        الكمية
                                    </div>

                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @php
                            $total_no_carton = 0;
                        @endphp
                        @foreach ($orders as $order)
                            <tr>
                                <td><strong>{{ $order->id }}</strong></td>
                                <td><strong>{{ $order->mosque->name }}</strong></td>
                                <td>
                                    {{ $order->mosque->district->name }}
                                </td>
                                <td>
                                    @php
                                        $no_carton = 0;
                                    @endphp
                                    @foreach ($order->details as $detail)
                                        @php
                                            $no_carton += intval($detail->product->no_carton * $detail->quantity);
                                            $total_no_carton += intval($detail->product->no_carton * $detail->quantity);
                                        @endphp
                                        <div class="row">
                                            <div class="col-9">
                                                {{ $detail->title }} <i class='bx bx-x'></i> {{  $detail->quantity }}
                                            </div>
                                            <div class="col-3">
                                                {{ $detail->product->no_carton * $detail->quantity }}
                                            </div>
                                        </div>
                                    @endforeach

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><strong>#</strong></td>
                            <td colspan="2"><strong>المجموع</strong></td>
                            <td>
                                <div class="row">
                                    <div class="col-9">
                                    </div>
                                    <div class="col-3">
                                        {{ $total_no_carton }}
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </form>
    </div>
@endsection

@section('js')
    <script>
        $("#send_orders").on("click", function(e) {
            // check-order
            e.preventDefault();
            var numberOfChecked = $('.check-order:checked').length;
            if (numberOfChecked > 0) {
                $("#form_assign").submit();
            } else {
                Swal.fire({
                    title: 'خطأ',
                    text: "لم يتم اختيار أي طلب لإسناده",
                    icon: 'warning',
                    showCancelButton: false,
                    confirmButtonText: 'رجوع!',
                    customClass: {
                        confirmButton: 'btn btn-primary me-3',
                        cancelButton: 'btn btn-label-secondary'
                    },
                    buttonsStyling: false
                });
            }
            // alert(numberOfChecked);
            // return false;
        });
        $("#check-order-all").on("click", function(e) {
            $('.check-order').not(this).prop('checked', this.checked);
        });
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
