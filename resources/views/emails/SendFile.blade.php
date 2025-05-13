<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
        @page {
            header: page-header;
            footer: page-footer;
            margin-top: 120px;
            margin-bottom: 100px;
        }
        .pagenum:before {
            content: counter(page);
        }

        .page-break {
            page-break-after: always;
        }

        table {
            display: table;
            width: 100%;
            border-spacing: 2px;
            border-collapse: collapse;
            max-width: 100%;
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
            font-family: "tajawal";
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

        h3 {
            font-size: 1.6em;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3>تقرير إسناد طلبات </h3>

        <table>
            <tr>
                <td class="text-center line">#</td>
                <td class="text-center line">رقم الطلب</td>
                <td class="text-center line">رقم الاوردر</td>
                <td class="text-center line">اسم المسجد</td>
                <td class="text-center line">المدينة</td>
                <td class="text-center line">الحي</td>
                <td class="text-center line">المنتج </td>
                <td class="text-center line">عدد الكراتين</td>
            </tr>
            @php
                $total_no_carton = 0;
            @endphp
            @forelse ($orders as $detail)
                <tr>
                    @php
                        $no_carton = 0;
                    @endphp
                    @php
                        $no_carton += intval($detail->product->no_carton * $detail->quantity);
                        $total_no_carton += intval($detail->product->no_carton * $detail->quantity);
                    @endphp
                    <td class="text-center line">{{ $loop->index + 1 }}</td>
                    <td class="text-center line">{{ $detail->id }}</td>
                    <td class="text-center line">{{ $detail->order->id }}</td>
                    <td class="text-center line">{{ $detail->mosque->name }}</td>
                    <td class="text-center line">{{ $detail->mosque->city->name }}</td>
                    <td class="text-center line">{{ $detail->mosque->district->name }}</td>
                    <td class="text-center line">{{ $detail->title }}</td>
                    <td class="text-center line">{{ number_format($no_carton, 0) }}</td>
    
                </tr>
            @empty
            @endforelse
            <tr>
                <td class="text-center line">#</td>
                <td class="text-center line" colspan="3">المجموع</td>
                <td class="text-center line">{{ number_format($total_no_carton, 0) }}</td>
            </tr>
        </table>
        <htmlpagefooter name="page-footer">
            <hr>
            <p class="text-center">https://qatra.sa</p>
        </htmlpagefooter>
    </div>
    
</body>

</html>
