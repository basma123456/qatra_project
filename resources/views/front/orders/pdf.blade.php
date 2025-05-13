<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
        .page-break {
            page-break-after: always;
        }

        @page {
            padding: 0mm;
            margin: 3mm;

        }

        table {
            display: table;
            width: 100%;
            border-spacing: 2px;
            border-collapse: collapse;
            max-width: 100%;
            /* margin-bottom: 1rem; */
            background-color: transparent;
            border: 0;
        }

        tr {
            display: table-row;
        }

        td {
            display: table-cell;
            padding: 0;
            padding-top: 10px;
            padding-bottom: 10px;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
            border: 0;
        }

        .line {
            border-bottom: 1px solid #dee2e6;
            margin-bottom: 5px;
            padding-bottom: 5px;
        }

        body {
            /* font-family: "tajawal"; */
            padding: 10px;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .w-100 {
            width: 100%;
            max-width: 100%;
        }

        .w-70 {
            width: 50%;
            max-width: 100%;
        }
        .qrcode {
            max-width: 140px;
        }

        h1,
        h2,
        h3,
        h4,
        p {
            margin: 0;
        }

        .h2,
        h2 {
            font-size: 2rem;

        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-bottom: 0.5rem;
            font-weight: 500;
            line-height: 1.2;
            color: inherit;
        }

        .mb-1 {
            margin-bottom: 0.25rem !important;
        }

        .mb-2 {
            margin-bottom: 0.5rem !important;
        }

        .mb-3 {
            margin-bottom: 1rem !important;
        }

        .mb-4 {
            margin-bottom: 1.5rem !important;
        }

        .mb-5 {
            margin-bottom: 3rem !important;
        }

        .my-3 {
            margin-bottom: 1rem !important;
            margin-top: 1rem !important;
        }

        .mt-5 {
            margin-top: 3rem !important;
        }

        .pb-1 {
            padding-bottom: 0.25rem !important;
        }

        .pb-2 {
            padding-bottom: 0.5rem !important;
        }

        .pb-3 {
            padding-bottom: 1rem !important;
        }

        .pb-4 {
            padding-bottom: 1.5rem !important;
        }

        .pb-5 {
            padding-bottom: 3rem !important;
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <td class="text-center"><img src="{{ asset('assets/images/logo') }}/logo.png" class="w-70" /></td>
        </tr>
        <tr>
            <td class="text-center">
                <h3>فاتورة ضريبية مبسطة</h3>
                <p>
                    الرقم الضريبي: 311215850700003
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <hr>
            </td>
        </tr>
        <tr>
            <td><b> العميل :</b> {{ $order->user->mobile }} - {{ $order->user->name }}</td>
        </tr>
        <tr>
            <td><b>فاتورة رقم :</b> {{ $order->id }}</td>

        </tr>
        <tr>
            <td><b>التاريخ : </b>
                {{ \Carbon\Carbon::parse($order->created_at)->translatedFormat('d-m-Y h:i A') }}</td>

        </tr>
        <tr>
            <td>
                <b>طريقة الدفع :</b>
                @if ($order->payment_type_id == 1)
                    {{ $order->payment->brand }} - {{ substr($order->payment->last4, -4) }}
                @else
                    حوالة بنكية - {{ $order->transfer->bank->name }}
                @endif
            </td>
        </tr>
        {{-- <tr>
            <td>
                <b>حالة الفاتورة :</b>
                {{ $order->order_status->name }}
            </td>
        </tr> --}}
        <tr>
            <td class="pb-4">
                <b>التسليم :</b>
                {{ $order->mosque->city->name }} - {{ $order->mosque->name }}
                @if ($order->delivery_type_id > 1)
                    <br>
                    ( {{ $order->delivery_name }} - {{ $order->delivery_mobile }} )
                @endif
            </td>
        </tr>
        <tr>
            <td>
                <table>
                    @foreach ($order->details as $detail)
                        <tr>
                            <td class="text-right line">
                                {{ $detail->quantity }} × {{ $detail->title }} × {{ $detail->price }} ريال
                            </td>
                            <td class="text-left line">{{ number_format($detail->price * $detail->quantity, 2) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td class="text-right line">المجموع غير شامل الضريبة</td>
                        <td class="text-left line">{{ number_format($order->total -$order->tax ,2) }}</td>
                    </tr>
                    <tr>
                        <td class="text-right line">الضريبة
                            {{ number_format(($order->tax / ($order->total - $order->tax)) * 100) }}% </td>
                        <td class="text-left line">{{ number_format($order->tax, 2) }}</td>
                    </tr>
                    <tr>
                        <td class="text-right line">الإجمالي شامل الضريبة</td>
                        <td class="text-left line">{{ number_format($order->total, 2) }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="text-center p-5">
                <img class="qrcode" src="data:image/png;base64,{{ base64_encode($qrcode) }}" />
            </td>
        </tr>
    </table>
    <p class="text-center my-3">{{ url('') }}</p>
</body>

</html>
