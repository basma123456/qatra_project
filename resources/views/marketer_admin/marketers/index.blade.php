@extends('marketer_admin.layout')

@section('title')
    إدارة المسوقين
@endsection

@section('css')
    <style>
        .badge {
            text-transform: lowercase;
        }

        .same_h{
            height: 29px !important;
        }

    </style>
@endsection

@section('breadcrumb')
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light"> نظام قطرة /</span><span class="text-muted fw-light">إدارة المسوقين /</span>
        استعراض
        المسوقين
    </h4>
@endsection

@section('content')
    <div class="card">
        <h5 class="card-header">استعراض المسوقين</h5>
        <div class="row mx-2 mb-4">
            <div class="col-md-2">

            </div>
                    <div class="col-md-10">
                        <div class="text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0">
                            <div class="dt-buttons">
{{--                                <a href="{{ route('marketer_admin.marketer.create') }}" class="btn btn-primary ms-3"><span><i class="bx bx-plus me-0 me-lg-2"></i> إضافة مسوق</span></a>--}}
                            </div>
                        </div>
                    </div>
        </div>
        <div class="table-responsive">
            <table id="main-datatable" class="table table-bordered  dt-responsive nowrap table-striped table-table-success table-hover" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
            <tr>
                    <th>م</th>
                    <th>اسم المسوق</th>
                    <th>الروابط</th>
                    <th>إجمالي الإيرادات</th>
                    <th>الكوبونات</th>
                    <th>عمليات</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @foreach ($marketers as $key => $marketer)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            <div class="mb-1"><strong>{{ $marketer->name }}</strong></div>
                            <div class="mb-1">{{ $marketer->mobile }}</div>
                            <div>{{ $marketer->email }}</div>
                        </td>


                        <td>
                            <div class="mb-2">
                                <span class="badge bg-light text-dark rounded-pill me-1">رابط التسويق</span>
{{--                                 <span class="badge bg-light text-dark rounded-pill me-1">{{ route('front.affiliate', $marketer->affiliate_code) }}</span>--}}


                                <input type="button" onclick="window.open('{{route('front.affiliate', $marketer->affiliate_code)}}' , '_blank')" class="btn btn-sm btn-outline-success" value="اذهب للرابط"    />

                                <input type="text" class="d-none" value="{{ route('front.affiliate', $marketer->affiliate_code) }}" >
                                <button class="btn btn-outline-orange btn-sm" onclick="myFunction(this)">انسخ الرابط</button>

                            </div>
                            <div>
                                <span class="badge bg-light text-dark rounded-pill me-1">رابط الاستعراض</span>
                                 <input type="button" onclick="window.open('{{route('front.affiliate.browse', $marketer->browse_code)}}' , '_blank')" class="btn btn-sm btn-outline-success" value="اذهب للرابط"    />

                                <input type="text" class="d-none" value="{{ route('front.affiliate.browse', $marketer->browse_code) }}" >
                                <button class="btn btn-outline-orange btn-sm" onclick="myFunction(this)">انسخ الرابط</button>

                            </div>



                        </td>
                        <td>{{ number_format($marketer->orders_sum_total) }}</td>
                        <td>
                            @foreach ($marketer->coupons as $coupon)
                                <div class="row">
                                    <div class="col-6">
                                        <div
                                            class="  alert p-1 @if ($coupon->status) alert-success @else alert-danger @endif text-center">
                                            {{ $coupon->code }}</div>
                                    </div>
                                    <div class="col-6 d-flex" style=" justify-content: space-between;">

                                        @if ($coupon->status)
                                            <a class="btn   btn-sm btn-danger same_h" style="height: 29px"
                                               href="{{ route('marketer_admin.coupon.deactivate', $coupon) }}">
                                                <i class='bx bx-x'></i> إلغاء التفعيل
                                            </a>
                                        @else
                                            <a class="btn  btn-sm btn-success same_h" style="height: 29px"
                                               href="{{ route('marketer_admin.coupon.activate', $coupon) }}">
                                                <i class='bx bx-check '></i> تفعيل
                                            </a>
                                        @endif
{{--                                        <form action="{{route('marketer_admin.coupon.delete' , $coupon->id)}}" method="post" >--}}
{{--                                            @csrf--}}
{{--                                            @method('delete')--}}
{{--                                            <button type="submit"  class="btn  mr-3 btn-sm btn-danger  " ><i class="fa fa-trash"></i></button>--}}

{{--                                        </form>--}}
                                    </div>
                                </div>
                            @endforeach

                        </td>

                        <td>
                            <div class="d-flex justify-content-center">
{{--                                @if($item->status == 1)--}}
{{--                                    <a href="{{ route('admin.products.update-status', $item->id )}}" name="@lang('admin.active')" class="btn btn-xs btn-success btn-sm m-1"><i class="fa fa-check"></i></a>--}}
{{--                                @else--}}
{{--                                    <a href="{{ route('admin.products.update-status', $item->id )}}" name="@lang('admin.dis_active')"  class="btn btn-xs btn-outline-secondary btn-sm m-1"><i class="fa fa-ban"></i></a>--}}
{{--                                @endif--}}

{{--                                @if($item->feature == 1)--}}
{{--                                    <a href="{{ route('admin.products.update-featured', $item->id )}}" name="@lang('admin.feature')"  class="btn btn-xs btn-warning btn-sm m-1"><i class="fa fa-star"></i></a>--}}
{{--                                @else--}}
{{--                                    <a href="{{ route('admin.products.update-featured', $item->id )}}" name="@lang('admin.feature')"  class="btn btn-xs btn-outline-secondary btn-sm m-1"><i class="fa fa-star"></i></a>--}}
{{--                                @endif--}}



                                <a href="{{ route('marketer_admin.marketer.show', $marketer->id) }}" name="@lang('admin.show')" class="btn btn-xs btn-outline-info btn-sm m-1"><i class="fas fa-eye"></i></a>


                                <a href="{{ route('marketer_admin.marketer.edit',$marketer->id) }}" name="@lang('admin.edit')" class="btn btn-outline-primary btn-sm m-1"><i class="fas fa-pencil-alt"></i></a>

{{--                                <a class="btn btn-outline-danger btn-sm m-1" name="@lang('admin.delete')" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $marketer->id }}">--}}
{{--                                    <i class="fas fa-trash-alt"> </i>--}}
{{--                                </a>--}}

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
                {{--            {{ $marketers->links() }}--}}
            </div>
        </div>
    </div>
@endsection

@section('js')

    <script>
        $(".confirm-delete").on("click", function (e) {
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
            }).then(function (result) {
                if (result.value) {
                    window.location.href = url;
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    return false;
                }
            });

        });

    </script>






@endsection
