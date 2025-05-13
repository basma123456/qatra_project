@extends('admin.layout')

@section('title')
    إدارة الرسائل
@endsection

@section('css')
@endsection

@section('breadcrumb')
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light"> نظام قطرة /</span><span class="text-muted fw-light">إدارة الرسائل /</span>
        استعراض
        الرسائل
    </h4>
@endsection

@section('content')
    <div class="card mt-4">
        <h5 class="card-header">استعراض الرسائل</h5>
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
                        <th>رقم الطلب</th>
                        <th>رقم الاوردر</th>
                        <th>الرسالة</th>
                        <th>السائق</th>
                        <th>تاريخ الإضافة</th>
                        <th>عمليات</th>
                    </tr>
                </thead>
                <tbody class="table-btransfer-bottom-0">
                    @foreach ($messages as $message)
                        <tr id="message_{{ $message->id }}">
                            <td><strong>{{ $message->order_details_id }}</strong></td>
                            <td><strong>{{ $message->order_id }}</strong></td>
                            <td>{{ $message->message }}</td>
                            <td>{{ $message->user->name }}</td>
                            <td>{{ $message->created_at }}</td>
                            <td>
                                @isset($message->order->images)
                                    عدد الصور : {{ $message->order->images->count() }}
                                    <button class="dropdown-item show_message" data-id="{{ $message->id }}"
                                        data-order="{{ $message->order_details_id }}" data-bs-toggle="modal"
                                        data-bs-target="#onboardImageModal"><i class="fa fa-eye me-1"></i>
                                        عرض</button>
                                    {{-- <a href="{{ route('admin.orders.images', $message->order_details_id) }}" class="dropdown-item">
                                        <i class="fas fa-pencil-alt"></i>
                                        تعديل الصور</button> --}}
                                @endisset

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
                        <h4 class="onboarding-title text-body">مراجعة رسالة للطلب رقم # <span id="order_id"></span></h4>
                        <div class="onboarding-info">
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div id="file_viewer" class="mb-3"></div>

                            </div>
                            <div class="col-sm-12">
                                <div id="message_result" class="mb-3">

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-success" id="btn_confirm" data-bs-dismiss="modal"
                                data-id="">
                                الموافقة على النشر
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

@section('script')
    <script>
        $("#btn_confirm").on("click", function(e) {
            var id = $(this).data("id");
            var url = "{{ url('admin/message/confirm/') }}/" + id;
            $("#message_result").load(url);
            $('#message_' + id).remove();
            $("#file_viewer").html("<p></p>");
            // alert(id);
        });
        $(".show_message").on("click", function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            var order = $(this).data("order");

            $("#order_id").html(order);
            $("#btn_confirm").data('id', id);

            var url = "{{ url('admin/message/item') }}/" + id;
            $("#file_viewer").load(url);
        });
    </script>
@endsection
