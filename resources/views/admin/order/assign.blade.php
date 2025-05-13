@extends('admin.layout')

@section('title')
إسناد الطلبات
@endsection

@section('css')
@endsection

@section('breadcrumb')
<h4 class="py-3 breadcrumb-wrapper mb-4">
    <span class="text-muted fw-light"> نظام قطرة /</span><span class="text-muted fw-light">إدارة الطلبات /</span> إسناد
    الطلبات
</h4>
@endsection

@section('content')
<div class="card mt-4">
    <h5 class="card-header">إسناد الطلبات</h5>

    <form class="card-body" action="{{ route('admin.orders.assign') }}" method="POST" id="form_assign">
        @csrf


        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th><input type="checkbox" class="form-check-input" id="check-order-all"></th>
                        <th>رقم الاوردر</th>
                        <th>رقم الطلب</th>
                        <th>اسم المسجد</th>
                        <th>المدينة</th>
                        <th>الحي</th>
                        <th>اسم العميل</th>
                        <th>جوال العميل</th>
                        <th>عدد الكراتين</th>
                        <th>الحالة</th>
                        {{-- <th>عمليات</th> --}}
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @php
                    $total_no_carton = 0;
                    @endphp

                    @forelse($orders as $order)
                        @forelse($order->details as $detail)
                        @if($detail->assigned_at != null)
                            @php continue; @endphp
                        @endif
                            <tr>
                                <td><input type="checkbox" class="form-check-input check-order" name="orders[]" value="{{ $detail->id }}"></td>
                                <td><strong>{{ $order->id }}</strong></td>
                                <td><strong>{{ $detail->id }}</strong></td>
                                <td><strong>{{ $detail->mosque->name }}</strong></td>
                                <td>{{ $detail->mosque->city->name }}</td> 
                                <td>
                                    {{ $detail->mosque->district->name }}
                                </td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->user->mobile }}</td>
                                <td>
                                    @php
                                    $no_carton = 0;
                                    @endphp
                                    @foreach ($order->details as $detail)
                                    @php
                                    $no_carton += intval(@$detail->product->no_carton * $detail->quantity);
                                    $total_no_carton += intval(@$detail->product->no_carton * $detail->quantity);
                                    @endphp
                                    @endforeach
                                    {{ $no_carton }}
                                </td>
                                <td>
                                    {{-- <span
                                                class="badge {{ $order->status()['badge'] }} me-1">{{ $order->status()['title'] }}</span> --}}
                                    {{ $order->order_status->name }}
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    @empty
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td>#</td>
                        <td colspan="6">المجموع</td>
                        <td>{{ $total_no_carton }}</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
            <div style="min-height: 100px;" class="mt-3">
                <div class="row">
                    <div class="col-md-3">
                        <select name="driver_id" class="form-select" id="largeSelect">
                            @foreach ($drivers as $driver)
                            <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="button" id="send_orders" class="btn btn-primary">اسناد</button>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-3 text-start">
                        <a href="{{ route('admin.orders.assign.report') }}" class="btn btn-primary">تقرير الطلبات
                            المسندة</a>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection

@section('script')
<script>
    $("#send_orders").on("click", function(e) {
        // check-order
        e.preventDefault();
        var numberOfChecked = $('.check-order:checked').length;
        console.log(numberOfChecked);
        if (numberOfChecked > 0) {
            $("#form_assign").submit();
        } else {
            Swal.fire({
                title: 'خطأ'
                , text: "لم يتم اختيار أي طلب لإسناده"
                , icon: 'warning'
                , showCancelButton: false
                , confirmButtonText: 'رجوع!'
                , customClass: {
                    confirmButton: 'btn btn-primary me-3'
                    , cancelButton: 'btn btn-label-secondary'
                }
                , buttonsStyling: false
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
