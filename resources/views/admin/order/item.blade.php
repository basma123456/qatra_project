@extends('admin.layout')

@section('title')
    إدارة الطلبات
@endsection

@section('css')
@endsection

@section('breadcrumb')
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light"> نظام قطرة /</span><span class="text-muted fw-light">إدارة الطلبات /</span> استعراض
        طلب
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
                        <h4>طلب رقم #{{ $order->id }}</h4>
                        <div class="mb-2">
                            <span class="me-1">التاريخ :</span>
                            <span
                                class="fw-semibold">{{ \Carbon\Carbon::parse($order->created_at)->translatedFormat('l d M Y') }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="me-1">الوقت :</span>
                            <span
                                class="fw-semibold">{{ \Carbon\Carbon::parse($order->created_at)->translatedFormat('h:i:s A') }}</span>
                        </div>

                    </div>
                </div>
            </div>
            <hr class="my-0">
            <div class="card-body">
                <div class="row p-sm-3 p-0">
                    <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
                        <h6 class="pb-2">منشأ الطلب:</h6>
                        <p class="mb-1">{{ $order->user->name }}</p>
                        <p class="mb-1">{{ $order->user->email }}</p>
                        <p class="mb-1">{{ $order->user->mobile }}</p>
                        <p class="mb-1">مكة المكرمة ، المملكة العربية السعودية</p>
                    </div>
                    <div class="col-xl-6 col-md-12 col-sm-7 col-12">
                        <h6 class="mb-3">تفاصيل الدفع :</h6>
                        <table>
                            <tbody>
                                @if ($order->payment_type_id == 1)
                                    <tr>
                                        <td>نوع البطاقة</td>
                                        <td>{{ $order->payment->brand }}</td>
                                    </tr>

                                    <tr>
                                        <td>رقم البطاقة</td>
                                        <td>{{ substr($order->payment->last4, -4) }}</td>
                                    </tr>
                                    <tr>
                                        <td>مرجع</td>
                                        <td>{{ $order->payment->transaction_id }}</td>
                                    </tr>
                                    <tr>
                                        <td>الحالة</td>
                                        <td>{{ $order->order_status->name }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>تم الدفع باستخدام</td>
                                        <td>حوالة بنكية</td>
                                    </tr>

                                    <tr>
                                        <td>اسم البنك</td>
                                        <td>{{ $order->transfer->bank->name }}</td>
                                    </tr>

                                    <tr>
                                        <td>الحالة</td>
                                        <td>{{ $order->order_status->name }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table border-top m-0">
                    <thead>
                        <tr>
                            <th>المنتج</th>
                            <th>السعر</th>
                            <th>الكمية</th>
                            <th>إجمالي</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->details as $detail)
                            <tr>
                                <td class="text-nowrap">{{ $detail->title }}</td>
                                <td>{{ number_format($detail->price, 2) }}</td>
                                <td>{{ number_format($detail->quantity, 0) }}</td>
                                <td>{{ number_format($detail->price * $detail->quantity, 2) }}</td>
                            </tr>
                        @endforeach

                        <tr>
                            <td colspan="2" class="align-top px-4 py-5">
                                <p>عنوان التوصيل :</p>
                                <p>{{ $order->mosque->city->name }},{{ $order->mosque->district->name }} -
                                    {{ $order->mosque->name }} </p>
                                <p>
                                    @if ($order->delivery_type_id > 1)
                                        ( {{ $order->delivery_name }} - {{ $order->delivery_mobile }} )
                                    @endif
                                </p>
                            </td>
                            <td class="text-end px-4 py-5">
                                <p class="mb-2 text-nowrap">إجمالي بدون الضريبة:</p>
                                <p class="mb-2 text-nowrap">الضريبة
                                    {{ number_format(($order->tax / ($order->total - $order->tax)) * 100) }}%:</p>
                                <p class="mb-0 text-nowrap">المجموع شامل الضريبة:</p>
                            </td>
                            <td class="px-4 py-5">
                                <p class="fw-semibold mb-2">{{ number_format($order->total - $order->tax, 2) }}</p>
                                <p class="fw-semibold mb-2">{{ number_format($order->tax, 2) }}</p>
                                <p class="fw-semibold mb-0">{{ number_format($order->total, 2) }}</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <span class="fw-semibold">قطرة خير</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
