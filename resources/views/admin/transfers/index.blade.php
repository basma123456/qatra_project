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
    @livewire('admin.transfer.index')
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
