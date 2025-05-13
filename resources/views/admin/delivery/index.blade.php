@extends('admin.layout')

@section('title')
    إدارة الطلبات
@endsection

@section('css')
    <style>
        .modal-onboarding form {
            text-align: right;
        }

        .progress {
            cursor: progress;
        }
    </style>
@endsection

@section('breadcrumb')
    {{-- <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light"> استعراض
        الطلبات
    </h4> --}}
@endsection

@section('content')
    <div class="card mt-4">
        <h5 class="card-header">استعراض الطلبات</h5>
        <div class="table-responsive text-nowrap">
            {{-- <table class="table table-striped">
                <thead>
                    <tr>
                        <th>رقم الطلب</th>
                        <th>اسم المسجد</th>
                        <th>المدينة</th>
                        <th>الحي</th>
                        <th>عمليات</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($orders as $order)
                        <tr>
                            <td><strong>{{ $order->id }}</strong></td>
                            <td><strong>{{ $order->mosque->name }}</strong></td>
                            <td>{{ $order->mosque->city->name }}</td>
                            <td>
                                {{ $order->mosque->district->name }}
                            </td>
                            <td>
                                <a class="dropdown-item" href="{{ route('admin.order.item', $order->id) }}"><i
                                        class="bx bx-edit-alt me-1"></i>
                                    استعراض</a>
                               
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table> --}}
            <div class="row">
                <div class="col-12 text-center ">
                    <button id="update_location" class="btn btn-primary ms-3">حدث موقعي</button><br>
                    @if (is_null($lat))
                        برجاء حدث موقعك
                    @else
                        موقعك {{ $lat }} , {{ $long }}
                    @endif
                </div>
                @foreach ($myorders as $item)
                    <div class="col-md-6 col-xl-4" id="row_{{ $item->order->id }}">
                        <div class="card shadow-none bg-transparent border border-primary m-2">
                            <div class="card-body">
                                <h5 class="card-title">طلب رقم #{{ $item->order->id }}</h5>
                                <p class="card-text">
                                    {{ $item->order->mosque->name }} ، {{ $item->order->mosque->city->name }} ،
                                    {{ $item->order->mosque->district->name }}
                                </p>
                                <p>يبعد عنك : {{ number_format($item->distance, 2) }} كم</p>


                                <ul class="p-0 m-0">
                                    @foreach ($item->order->details as $detail)
                                        <li class="d-flex mb-3">
                                            <div
                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <p class="mb-0 lh-1">{{ $detail->title }} </p>
                                                </div>
                                                <div class="item-progress">الكمية:{{ $detail->quantity }}</div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="row justify-content-center">
                                    <div class="col text-center">
                                        <a href="https://www.google.com/maps/search/?api=1&query={{ $item->order->mosque->latitude }},{{ $item->order->mosque->longitude }}"
                                            target="_blank" class="btn rounded-pill btn-icon btn-label-primary">
                                            <span class="tf-icons bx bx-map"></span>
                                        </a>
                                    </div>
                                    <div class="col text-center">
                                        {{-- <a href="" class="btn rounded-pill btn-icon btn-label-primary">
                                            <span class="tf-icons bx bxs-camera-plus"></span>
                                        </a> --}}
                                        <button data-order-id="{{ $item->order_id }}" type="button"
                                            class="btn rounded-pill btn-icon btn-label-primary update_order_btn"
                                            data-bs-toggle="modal" data-bs-target="#onboardImageModal">
                                            <span class="tf-icons bx bxs-camera-plus"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
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
                        <h4 class="onboarding-title text-body">تحديث حالة طلب رقم # <span id="order_id"></span></h4>
                        <div class="onboarding-info">

                        </div>
                        <form id="form_update" action="{{ route('admin.delivery.update') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    @for ($i = 1; $i <= 4; $i++)
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">صورة {{ $i }}</label>
                                            <input name="img[]" class="form-control" type="file"
                                                id="formFile{{ $i }}" onchange="previewImage(this)"
                                                data-output="formfilepreview{{ $i }}"
                                                data-button="button_remove_image{{ $i }}" />
                                            <img class="border p-1 my-1 w-100 rounded" src=""
                                                id="formfilepreview{{ $i }}" style="display: none" />
                                            <button type="button" class="btn btn-danger mt-2 p-2 button_remove_image"
                                                id="button_remove_image{{ $i }}"
                                                data-output="formfilepreview{{ $i }}"
                                                data-file="formFile{{ $i }}" style="display: none"><i
                                                    class='bx bx-x-circle'></i></button>
                                        </div>
                                    @endfor
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">تفاصيل أخرى</label>
                                        <textarea class="form-control" name="message" rows="3"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="roleEx3" class="form-label">اختر حالة الطلب الجديدة</label>
                                        <div class="form-check">
                                            <input name="status" class="form-check-input" type="radio" value="1"
                                                id="defaultRadio1" checked="checked">
                                            <label class="form-check-label" for="defaultRadio1"> تم التوصيل </label>
                                        </div>
                                        <div class="form-check">
                                            <input name="status" class="form-check-input" type="radio" value="0"
                                                id="defaultRadio2">
                                            <label class="form-check-label" for="defaultRadio2"> تعذر التوصيل </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input id="input_order_id" name="order_id" value="" type="hidden" />
                        </form>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                        إغلاق
                    </button>
                    <button type="button" id="btn_form_submit" class="btn btn-primary"
                        data-bs-dismiss="modal">إرسال</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script>
        var order_id_form = null;
        $("#update_location").on("click", function(e) {
            $(this).addClass = "progress";
            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var longitude = position.coords.longitude;
                    var latitude = position.coords.latitude;
                    var url = "{{ url('admin/delivery/position') }}" + "/" + latitude + "/" + longitude;
                    window.location = url;
                });
            }

        });

        $("#btn_form_submit").on("click", function(e) {
            e.preventDefault();
            var order_id = $("#input_order_id").val();
            
            var formData = new FormData(document.getElementById("form_update"));
            $("body").find("*").attr("disabled", "disabled");
            $.ajax({
                    url: '{{ route('admin.delivery.update') }}',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                })
                .done(function(data) {
                    var returnedData = JSON.parse(data);
                    if (returnedData.status == 1) {
                        // $('#row_' + order_id).remove();
                        // location.reload();
                        // $('#form_update').trigger("reset");
                        // $( ".button_remove_image" ).each(function() {
                        //     $( this ).trigger("click");
                        // });
                        // document.getElementById("form_update").reset();
                        location.reload();
                    }else{
                        alert("حدثت مشكلة أثناء رفع الملفات الرجاء المحاولة مرة أخرى");
                        location.reload();
                    }
                    // $('#form_update').trigger("reset");
                    
                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    alert("Error: " + errorThrown);
                    location.reload();
                    // location.reload();
                });;
            
        });
        $(".update_order_btn").on("click", function(e) {
            $("#order_id").html($(this).data("order-id"));
            $("#input_order_id").val($(this).data("order-id"));
            // order_id_form = $(this).data("order-id");
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
