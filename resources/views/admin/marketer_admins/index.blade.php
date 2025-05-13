@extends('admin.layout')

@section('title')
إدارة المديرين التسويق
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
    <span class="text-muted fw-light"> نظام قطرة /</span><span class="text-muted fw-light">إدارة  مديرين التسويق /</span> استعراض
    المديرين التسويق
</h4>
@endsection

@section('content')
<div class="card">
    <h5 class="card-header">استعراض مديرين التسويق</h5>
    <div class="row mx-2 mb-4">
        <div class="col-md-2">

        </div>
        <div class="col-md-10">
            <div class="text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0">
                <div class="dt-buttons">
                    <a href="{{ route('admin.marketer_admin.create') }}" class="btn btn-primary ms-3"><span><i class="bx bx-plus me-0 me-lg-2"></i> إضافةمدير التسويق</span></a>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table id="main-datatable" class="table table-bordered  dt-responsive nowrap table-striped table-table-success table-hover" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
            <tr>
                <th>م</th>
                <th>اسم مدير التسويق</th>
{{--                <th>الروابط</th>--}}
{{--                <th>إجمالي الإيرادات</th>--}}
{{--                <th>الكوبونات</th>--}}
                <th>اظهار المسوقين</th>
                <th>عمليات</th>
            </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            @foreach ($marketer_admins as $key => $marketer_admin)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>
                        <div class="mb-1"><strong>{{ $marketer_admin->name }}</strong></div>
                        <div class="mb-1">{{ $marketer_admin->mobile }}</div>
                        <div>{{ $marketer_admin->email }}</div>
                    </td>
                    <td>
                            @livewire('marketer-admin.show-marketers' , ['marketer_admin' => $marketer_admin])
                    </td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('admin.marketer_admin.show', $marketer_admin->id) }}" name="@lang('admin.show')" class="btn btn-xs btn-outline-info btn-sm m-1"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('admin.marketer_admin.edit',$marketer_admin->id) }}" name="@lang('admin.edit')" class="btn btn-outline-primary btn-sm m-1"><i class="fas fa-pencil-alt"></i></a>
                            <a class="btn btn-outline-danger btn-sm m-1" name="@lang('admin.delete')" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $marketer_admin->id }}">
                                <i class="fas fa-trash-alt"> </i>
                            </a>

                        </div>
                    </td>

                </tr>
            @endforeach
            </tbody>
            <script>
                function myFunction(copyText) {
                    // Get the text field
                    // var copyText = document.getElementById("myInput");
                    // Select the text field
                    copyText.previousElementSibling.select();
                    copyText.previousElementSibling.setSelectionRange(0, 99999); // For mobile devices

                    // Copy the text inside the text field
                    navigator.clipboard.writeText(copyText.previousElementSibling.value);

                    // Alert the copied text
                    alert("تم نسخ الرابط : " + copyText.previousElementSibling.value);
                }
            </script>



        </table>
        <div style="min-height: 100px;">
            {{--            {{ $marketer_admins->links() }}--}}
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
