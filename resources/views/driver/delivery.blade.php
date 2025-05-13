@extends('driver.layout')

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

@section('content')
<div class="card mt-4">
    <h5 class="card-header">استعراض الطلبات</h5>
    <div class="table-responsive text-nowrap">
        <div class="row">
            <div class="col-12 text-center ">
                <button id="update_location" class="btn btn-primary ms-3">حدث موقعي</button><br>
                @if (is_null($lat))
                برجاء حدث موقعك
                @else
                موقعك {{ $lat }} , {{ $long }}
                @endif
            </div>
            @forelse ($myorders as $item)
            @livewire('driver.delivery.index', ['item' => $item])
            @empty
            @endforelse
        </div>
        <div style="min-height: 100px;">
        </div>
    </div>
</div>



@endsection


@section('script')
<script>
    var order_id_form = null;
    $("#update_location").on("click", function(e) {
        $(this).addClass = "progress";
        if ("geolocation" in navigator) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var longitude = position.coords.longitude;
                var latitude = position.coords.latitude;
                var url = "{{ url('drivers/delivery/position') }}" + "/" + latitude + "/" + longitude;
                window.location = url;
            });
        }

    });

    $("#btn_form_submit").on("click", function(e) {
        e.preventDefault();
        var order_id = $("#input_order_id").val();
        var order_details_id = $("#input_order_details_id").val();

        var formData = new FormData(document.getElementById("form_update"));
        $("body").find("*").attr("disabled", "disabled");
        $.ajax({
                url: '{{ route("drivers.delivery.update") }}'
                , type: 'POST'
                , data: formData
                , cache: false
                , contentType: false
                , processData: false
            })
            .done(function(data) {
                var returnedData = JSON.parse(data);
                console.log(data);
                console.log(returnedData);
                if (returnedData.status == 1) {
                    $('#row_' + order_id).remove();
                    location.reload();
                    $('#form_update').trigger("reset");
                    $(".button_remove_image").each(function() {
                        $(this).trigger("click");
                    });
                    document.getElementById("form_update").reset();
                    location.reload();
                } else {
                    alert("حدثت مشكلة أثناء رفع الملفات الرجاء المحاولة مرة أخرى");
                    // location.reload();
                }
                $('#form_update').trigger("reset");

            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                alert("Error: " + errorThrown);
                // location.reload();
                // location.reload();
            });;

    });
    $(".update_order_btn").on("click", function(e) {
        $("#order_id").html($(this).data("order-id"));
        $("#input_order_id").val($(this).data("order-id"));
        $("#input_order_details_id").val($(this).data("orderdetails-id"));
        $("#order_delivery_id").val($(this).data("orderdrivery-id"));
        console.log("input_order_id : ", $("#input_order_id").val());
        console.log("input_order_details_id : ", $("#input_order_details_id").val());
        console.log("order_delivery_id : ", $("#order_delivery_id").val(), $(this).data("orderdrivery-id"));
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
