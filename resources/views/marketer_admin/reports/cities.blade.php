@extends('admin.layout')

@section('title')
    اعلى المدن شراء
@endsection

@section('css')

@endsection

@section('breadcrumb')
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light"> نظام قطرة /</span><span class="text-muted fw-light">تقارير  /</span> اعلى المدن شراء
    </h4>
@endsection
<style>
    /* Custom styles to mimic the design in the image */
    .custom-table thead th {
        background-color: #f2f7fc;
        color: #333;
        text-align: right;
    }

    .custom-table tbody td {
        background-color: #f7fcff;
        color: #333;
        text-align: right;
    }

    .custom-table th, .custom-table td {
        padding: 12px;
        border: none;
    }

    .custom-table tbody tr:nth-child(even) {
        background-color: #eef7ff;
    }

    .custom-table {
        width: 100%;
        border-collapse: collapse;
    }

    .table-title {
        font-size: 24px;
        margin-bottom: 20px;
    }

    .table-wrapper {
        margin: 0 auto;
        width: 90%;
    }
</style>

@section('content')
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
            <tr>
                <th>المدينة</th>
                <th>عدد الطلبات</th>
                <th>الاجمالي</th>

            </tr>
            </thead>
            <tbody>
            @foreach($reportData as $data)
                <tr>
                    <td>{{ $data['city_name'] }}</td>
                    <td>{{ $data['orders_count'] }}</td>
                    <td>{{ number_format($data['total_orders']) }} </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

