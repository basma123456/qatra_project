@extends('admin.layout')

@section('title')
    إدارة التحويلات
@endsection

@section('css')
@endsection

@section('breadcrumb')
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light"> نظام قطرة /</span><span class="text-muted fw-light">إدارة التحويلات /</span>
        استعراض
        التحويلات
    </h4>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>التحويلات المضافة</span>
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
                            <span>طلبات في انتظار التأكيد</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">{{ $statistics['waiting'] }}</h4>
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
                            <span>التحويلات المؤكدة</span>
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
        <h5 class="card-header">استعراض التحويلات</h5>
        <div class="row mx-2 mb-4">
            <div class="col-md-2">

            </div>
            <div class="col-md-10">
                <div
                    class="text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0">
                    {{-- <div class="dt-buttons"> <a href="{{ route('admin.transfer.create') }}"
                            class="btn btn-primary ms-3"><span><i class="bx bx-plus me-0 me-lg-2"></i> إضافة مسجد</span></a>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>اسم البنك</th>
                        <th>مبلغ التحويل</th>
                        <th>رقم الطلب</th>
                        <th>الحالة</th>
                        <th>عمليات</th>
                    </tr>
                </thead>
                <tbody class="table-btransfer-bottom-0">
                    @foreach ($transfers as $transfer)
                        <tr id="transfer_{{ $transfer->id }}">
                            <td><strong>{{ $transfer->bank->name }}</strong></td>
                            <td>{{ $transfer->amount }}</td>
                            <td>
                                {{ $transfer->order_id }}
                            </td>
                            <td>
                                <span
                                    class="badge {{ $transfer->status()['badge'] }} me-1">{{ $transfer->status()['title'] }}</span>
                                {{-- {{ $transfer->transfer_status->name }} --}}
                            </td>
                            <td>
                                @if($transfer->status==0)
                                <button class="dropdown-item show_transfer" data-total="{{ $transfer->order->total }}"
                                    data-id="{{ $transfer->id }}" data-order="{{ $transfer->order->id }}"
                                    data-bs-toggle="modal" data-bs-target="#onboardImageModal"><i
                                        class="bx bx-edit-alt me-1"></i>
                                    عرض</button>
                                @else
                                    <p>تم التفعيل في {{ $transfer->updated_at }}</p>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="min-height: 100px;">

            </div>
        </div>
    </div>

    <div class="modal-onboarding modal fade animate__animated" id="onboardImageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content text-center">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="onboarding-media">
                        <div class="mx-2">
                            {{-- <img src="assets/img/illustrations/girl-unlock-password-light.png"
                                alt="girl-unlock-password-light" width="335" class="img-fluid"
                                data-app-light-img="illustrations/girl-unlock-password-light.png"
                                data-app-dark-img="illustrations/girl-unlock-password-dark.png" /> --}}
                        </div>
                    </div>
                    <div class="onboarding-content mb-0">
                        <h4 class="onboarding-title text-body">مراجعة حوالة طلب رقم # <span id="order_id"></span></h4>
                        <p>إجمالي المبلغ المستحق على الطلب : <span id="total"></span> ريال</p>
                        <div class="onboarding-info">
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div id="file_viewer" class="mb-3"></div>

                            </div>
                            <div class="col-sm-12">
                                <div id="transfer_result" class="mb-3">

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-success" id="btn_confirm" data-bs-dismiss="modal"
                                data-id="">
                                تأكيد الحوالة
                            </button>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                إغلاق
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $("#btn_confirm").on("click", function(e) {
            var id = $(this).data("id");
            var url = "{{ url('admin/transfer/confirm/') }}/" + id;
            $("#transfer_result").load(url);
            $('#transfer_' + id).remove();
            $("#file_viewer").html("<p></p>");
            // alert(id);
        });
        $(".show_transfer").on("click", function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            var order = $(this).data("order");
            var total = $(this).data("total");

            $("#order_id").html(order);
            $("#total").html(total);
            $("#btn_confirm").data('id', id);

            var url = "{{ url('admin/transfer/file') }}/" + id;
            $("#file_viewer").load(url);
        });
    </script>
@endsection
