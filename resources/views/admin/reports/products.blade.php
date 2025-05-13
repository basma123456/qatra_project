@extends('admin.layout')

@section('title')
    اعلى المنتجات شراء
@endsection

@section('css')

@endsection

@section('breadcrumb')
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light"> نظام قطرة /</span><span class="text-muted fw-light">تقارير  /</span> اعلى
        المنتجات شراء
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
    <label >التاريخ</label>
    <form method="GET" action="{{ route('admin.reports.products') }}">
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="date_from">من</label>
                <input type="date" id="date_from" name="date_from" value="{{ request('date_from') }}"
                       class="form-control">
            </div>

            <div class="col-md-4 form-group">
                <label for="date_to">الى</label>
                <input type="date" id="date_to" name="date_to" value="{{ request('date_to') }}" class="form-control">
            </div>

            <div class="col-md-3">
                <button type="submit" class="btn btn-primary mt-4">بحث</button>
            </div>

        </div>


    </form>
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
        <tr>
            <th>المنتجات</th>
            <th>عدد الطلبات</th>
            <th>الاجمالي</th>

        </tr>
        </thead>
        <tbody>
        @foreach($reportData as $data)
            <tr>
                <td>{{ $data['product_name'] }}</td>
                <td>{{ $data['total_quantity_sold'] }}</td>
                <td>{{ number_format($data['total_revenue']) }} </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection

