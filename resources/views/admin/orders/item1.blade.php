@extends('admin.layout')

@section('title')
    إدارة الطلبات
@endsection

@section('css')
@endsection

@section('breadcrumb')
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light"> نظام قطرة /</span><span class="text-muted fw-light">إدارة الطلبات /</span>
        تفاصيل حوالة
    </h4>
@endsection

@section('content')
    <div class="col-xl-9 col-md-8 col-12 mb-md-0 mb-4">
        <div class="card invoice-preview-card">
            <div class="card-body">
                <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column p-sm-3 p-0">
                    <div class="mb-xl-0 mb-4">
                        <div class="d-flex svg-illustration mb-3 gap-2">
                            <a href="{{ route('admin.home') }}" class="app-brand-link gap-2">

                                <span class="app-brand-text demo menu-text fw-bold"><img
                                        src="{{ url('assets/images/logo/logo.png') }}" class="w-100"
                                        style="max-height: 35px;" /></span>
                            </a>
                        </div>
                        {{-- <p class="mb-1">Office 149, 450 South Brand Brooklyn</p>
                        <p class="mb-1">San Diego County, CA 91905, USA</p>
                        <p class="mb-0">+1 (123) 456 7891, +44 (876) 543 2198</p> --}}
                    </div>
                    <div>
                        <h4>طلب رقم #{{ $transfer->order->id }}</h4>
                        <div class="mb-2">
                            <span class="me-1">التاريخ :</span>
                            <span
                                class="fw-semibold">{{ \Carbon\Carbon::parse($transfer->order->created_at)->translatedFormat('l d M Y') }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="me-1">الوقت :</span>
                            <span
                                class="fw-semibold">{{ \Carbon\Carbon::parse($transfer->order->created_at)->translatedFormat('h:i:s A') }}</span>
                        </div>

                    </div>
                </div>
            </div>
            <hr class="my-0">
            <div class="card-body">
                <div class="row p-sm-3 p-0">
                    <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
                        <h6 class="pb-2">منشأ الطلب:</h6>
                        <p class="mb-1">{{ $transfer->order->user->name }}</p>
                        <p class="mb-1">{{ $transfer->order->user->email }}</p>
                        <p class="mb-1">{{ $transfer->order->user->mobile }}</p>
                    </div>
                    <div class="col-xl-6 col-md-12 col-sm-7 col-12">
                        <h6 class="mb-3">تفاصيل الدفع :</h6>
                        <table>
                            <tbody>
                                @if ($transfer->order->payment_type_id == 1)
                                    <tr>
                                        <td>نوع البطاقة</td>
                                        <td>{{ $transfer->order->payment->brand }}</td>
                                    </tr>

                                    <tr>
                                        <td>رقم البطاقة</td>
                                        <td>{{ substr($transfer->order->payment->last4, -4) }}</td>
                                    </tr>
                                    <tr>
                                        <td>مرجع</td>
                                        <td>{{ $transfer->order->payment->transaction_id }}</td>
                                    </tr>
                                    <tr>
                                        <td>الحالة</td>
                                        <td>{{ $transfer->order->order_status->name }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>تم الدفع باستخدام</td>
                                        <td>حوالة بنكية</td>
                                    </tr>

                                    <tr>
                                        <td>اسم البنك</td>
                                        <td>{{ $transfer->order->transfer->bank->name }}</td>
                                    </tr>

                                    <tr>
                                        <td>الحالة</td>
                                        <td>{{ $transfer->order->order_status->name }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row p-sm-3 p-0">
                    <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
                        @if($is_file_pdf)

                        @else
                        <img class="img-fliud border m-2" src="{{ url("storage/".$transfer->transfer_img) }}">
                        @endif
                    </div>
                    <div class="col-xl-6 col-md-12 col-sm-7 col-12">
                        <a class="btn btn-success" href="">تأكيد الحوالة</a>
                    </div>
                </div>
            </div>



        </div>
    </div>
@endsection
