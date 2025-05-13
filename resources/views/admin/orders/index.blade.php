@extends('admin.layout')
<style>
    @media (min-width: 1400px) {

        .container-xxl,
        .container-xl,
        .container-lg,
        .container-md,
        .container-sm,
        .container {
            max-width: 1670px !important;
        }
    }

</style>
@section('title')
إدارة الطلبات
@endsection

@section('css')
<link rel="stylesheet" href="{{ url('admin') }}/assets/vendor/libs/flatpickr/flatpickr.css" />
@endsection

@section('breadcrumb')
<h4 class="py-3 breadcrumb-wrapper mb-4">
    <span class="text-muted fw-light"> نظام قطرة /</span><span class="text-muted fw-light">إدارة الطلبات /</span>
    استعراض
    الطلبات
</h4>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span>الطلبات المضافة</span>
                        <div class="d-flex align-items-end mt-2">
                            <h4 class="mb-0 me-2">{{ $statistics['all'] }}</h4>
                        </div>
                        <small>طلب</small>
                    </div>
                    <span class="badge bg-label-primary rounded p-2">
                        <i class="bx bx-customize bx-sm"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span>طلبات في انتظار تأكيد التحويل</span>
                        <div class="d-flex align-items-end mt-2">
                            <h4 class="mb-0 me-2">{{ $statistics['transfer'] }}</h4>
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
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span>طلبات في انتظار التنفيذ</span>
                        <div class="d-flex align-items-end mt-2">
                            <h4 class="mb-0 me-2">{{ $statistics['waiting'] }}</h4>
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
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span>الطلبات المنفذة</span>
                        <div class="d-flex align-items-end mt-2">
                            <h4 class="mb-0 me-2">{{ $statistics['finished'] }}</h4>
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

<div class="card mt-4">
    <h5 class="card-header">استعراض الطلبات</h5>
    <form class="card-body" action="{{ route('admin.order.index') }}" method="POST">
        @csrf
        <div class="row mx-2 mb-4">
            <div class="col-md-2">
                <input type="text" name="order_id" value="{{ old('order_id', $request->order_id) }}" class="form-control" placeholder="رقم الطلب" />
                <label class="form-label">رقم الطلب</label>
            </div>
            <div class="col-md-2">
                <input type="text" name="mobile" value="{{ old('mobile', $request->mobile) }}" class="form-control" placeholder="جوال العميل" />
                <label class="form-label">جوال العميل</label>
            </div>
            <div class="col-md-2">
                <input type="text" name="total" value="{{ old('total', $request->total) }}" class="form-control" placeholder="المبلغ" />
                <label class="form-label">المبلغ</label>
            </div>
            <div class="col-md-2">
                <input type="text" name="from_date" id="from_date" value="{{ old('from_date', $request->from_date) }}" class="form-control flatpickr-input" placeholder="YYYY-MM-DD" />
                <label for="from_date" class="form-label">من تاريخ</label>
            </div>
            <div class="col-md-2">
                <input type="text" name="to_date" id="to_date" value="{{ old('to_date', $request->to_date) }}" class="form-control flatpickr-input" placeholder="YYYY-MM-DD" />
                <label class="form-label">إلى تاريخ</label>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">بحث</button>
            </div>
            <div class="col-md-12 mt-3">
                <div class="row">
                    @foreach ($order_statuses as $item)
                    @if ($item->id != 201)
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="order_status_id[]" id="order_status_id_{{ $item->id }}" value="{{ $item->id }}" @if (is_array(old('order_status_id', $request->order_status_id)) &&
                            in_array($item->id, old('order_status_id', $request->order_status_id))) checked @endif>
                            <label class="form-check-label" for="order_status_id_{{ $item->id }}">{{ $item->name }}</label>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </form>
    @if ($orders->count() > 0)

    <table class="table table-striped">
        <thead>
            <tr>
                <th>رقم الطلب</th>
                <th>التاريخ</th>
                <th>اسم المسجد</th>
                @unlessrole('Accountant')
                <th>المدينة</th>
                <th>الحي</th>
                @endunlessrole
                <th>اسم العميل</th>
                <th>جوال العميل</th>
                @hasanyrole('Accountant')
                <th>المبلغ</th>
                <th>طريقة الدفع</th>
                @endhasanyrole
                <th>الحالة</th>
                @hasanyrole('Accountant')
                <th>عمليات</th>
                @endhasanyrole
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @foreach ($orders as $order)
            <tr>
                <td><strong>{{ $order->id }}</strong></td>
                <td class="text-center">
                    {{ date('Y-m-d', strtotime($order->created_at)) }}<br>
                    {{ date('h:i A', strtotime($order->created_at)) }}
                </td>
                <td>
                    <strong>
                        <a href="https://www.google.com/maps/search/?api=1&query={{ $order->mosque->latitude ?? '' }},{{ $order->mosque->longitude ?? '' }}" target="_blank">{{ $order->mosque->name ?? '' }}
                        </a>
                    </strong>
                </td>
                @unlessrole('Accountant')
                <td>{{ $order->mosque->city->name ?? '' }}</td>
                <td>
                    {{ $order->mosque->district->name ?? '' }}
                </td>
                @endunlessrole
                <td>
                    {{ $order->user->name ?? '' }}
                </td>
                <td>
                    {{ $order->user->mobile ?? '' }}
                    <a class="btn btn-outline-success mx-0 p-1 btn-whatsapp " id="{{$order->user->id}}">
                        <i class="bx bxl-whatsapp"></i>
                    </a>
                </td>
                @hasanyrole('Accountant')
                <td>{{ $order->total }}</td>
                <td>
                    {{ $order->payment_type->name_ar }}
                    @if (isset($order->payment->brand))
                    <p class="small">{{ $order->payment->brand }}</p>
                    @endif
                </td>
                @endhasanyrole
                <td>
                    {{-- <span
                            class="badge {{ $order->status()['badge'] }} me-1">{{ $order->status()['title'] }}</span> --}}
                    {{ $order->order_status->name }}
                    <br>عدد الصور : {{ $order->images->count() }}
                </td>
                <td>
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('admin.order.item', $order->id) }}"><i class="bx bx-edit-alt me-1"></i>
                                استعراض</a>
                            {{-- <a target="_blank" class="dropdown-item"
                                        href="{{ route('admin.order.pdf', $order->id) }}"><i class="bx bxs-file-pdf me-1"></i>
                            ملف pdf</a> --}}
                            @php
                            $code = App\Helpers\OrderPublic::getCode($order);
                            // $verify = $order->id * $order->mosque_id * $order->user_id * 314 + $order->user_id;
                            // $code = str_replace('=', '', base64_encode($order->id . '|' . $order->mosque_id . '|' . $order->user_id . '|' . $verify));
                            @endphp
                            {{-- <a target="_blank" class="dropdown-item" href="{{ route('front.orders.public.pdf', $code) }}"><i class="bx bxs-file-pdf me-1"></i>
                                ملف pdf</a> --}}
                            <a target="_blank" class="dropdown-item" href="{{ route('admin.order.images', $order->id) }}"><i class="bx bx-images me-1"></i>
                                صور التوصيل</a>
                            {{-- <a class="dropdown-item" href="{{ route('admin.order.edit', $order->id) }}"><i class="bx bx-edit-alt me-1"></i>
                            تعديل</a>
                            <a class="dropdown-item confirm-delete" href="{{ route('admin.order.delete', $order->id) }}"><i class="bx bx-trash me-1"></i>
                                حذف</a> --}}
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if ($export)
    <a class="btn btn-primary m-4" href="{{ route('admin.order.export') }}">تصدير البيانات Excel</a>
    @endif

    <div style="min-height: 100px;">
        {{ $orders->links() }}
    </div>

    @else
    <div class="p-4 border border-danger rounded m-5 text-center text-danger mt-0">عفواً ... لا يوجد نتائج
        لعملية
        الفرز الخاصة بك
    </div>
    @endif
</div>
@endsection

@section('js')
<script src="{{ url('admin') }}/assets/vendor/libs/flatpickr/flatpickr.js"></script>
<script src="{{ url('admin') }}/assets/js/forms-pickers.js"></script>

<script>
    document.querySelector('#from_date').flatpickr({
        monthSelectorType: 'static'
    });
    document.querySelector('#to_date').flatpickr({
        monthSelectorType: 'static'
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

    $(".btn-whatsapp").on("click", function(e) {
        var id = $(this).attr('id');
        Swal.fire({
            title: 'ادخل الرسالة'
            , input: 'text'
            , inputPlaceholder: 'مرحبا....'
            , showCancelButton: true
            , confirmButtonText: 'ارسال'
            , cancelButtonText: 'إلغاء'
            , showLoaderOnConfirm: true, // shows loader on confirm button
            preConfirm: (inputValue) => {
                if (!inputValue) {
                    Swal.showValidationMessage('يجب عليك أن تكتب شيئاً ما!');
                    return false;
                }

                return new Promise((resolve, reject) => {
                    $.ajax({
                        url: '/admin/order/send-message'
                        , type: 'POST'
                        , data: {
                            id: id
                            , message: inputValue
                        , }
                        , headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                        , success: function(response) {
                            resolve(response); // handle success
                        }
                        , error: function(xhr, status, error) {
                            Swal.showValidationMessage(`فشل الطلب: ${error}`);
                            reject();
                        }
                    });
                });
            }
            , allowOutsideClick: () => !Swal.isLoading() // prevent closing the alert while loading
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'تم الارسال!'
                    , icon: 'success'
                });
            }
        });
    });


    // $('.flatpickr-date').flatpickr({
    //     monthSelectorType: 'static'
    // });

</script>
@endsection
