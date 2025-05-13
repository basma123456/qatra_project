@extends('marketer_admin.layout')

@section('title')
    إدارة الطلبات
@endsection

@section('css')
    <link rel="stylesheet" href="{{ url('admin') }}/assets/vendor/libs/flatpickr/flatpickr.css" />
@endsection

@section('breadcrumb')
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light"> نظام قطرة /</span><span class="text-muted fw-light">إدارة الطلبات /</span>
        استعراض
        الطلبات
    </h4>
@endsection

@section('content')

    @livewire('marketer-admin.orders.index')

@endsection

@section('js')
    <script src="{{ url('admin') }}/assets/vendor/libs/flatpickr/flatpickr.js"></script>
    <script src="{{ url('admin') }}/assets/js/forms-pickers.js"></script>

@endsection
