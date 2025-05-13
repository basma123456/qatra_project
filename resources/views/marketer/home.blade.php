@extends('marketer.layout')

{{--@section('title')--}}
{{--@endsection--}}
{{--@yield('title' , 'Qatra')--}}
{{--@yield('title_page' , 'Qatra')--}}

@section('css')
@endsection

@section('breadcrumb')

    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light">إدارة نظام قطرة /</span> الصفحة الرئيسية
    </h4>


    <h2> اهلا {{auth()->guard('marketer')->user()->name}}</h2>
    <br><br><br>
    <div class="container m-auto text-center">
    <div>
        <div class="mb-2">
            <span class="badge bg-light text-dark rounded-pill me-1">رابط التسويق</span>
            {{--                                 <span class="badge bg-light text-dark rounded-pill me-1">{{ route('front.affiliate', $marketer->affiliate_code) }}</span>--}}


            <input type="button"
                   onclick="window.open('{{route('front.affiliate', auth()->guard('marketer')->user()->affiliate_code)}}' , '_blank')"
                   class="btn btn-sm btn-outline-success" value="اذهب للرابط"/>

            <input type="text" class="d-none"
                   value="{{ route('front.affiliate', auth()->guard('marketer')->user()->affiliate_code) }}">
            <button class="btn btn-outline-orange btn-sm" onclick="myFunction(this)">انسخ الرابط</button>

        </div>

        <div>
            <span class="badge bg-light text-dark rounded-pill me-1">رابط الاستعراض</span>
            <input type="button"
                   onclick="window.open('{{route('front.affiliate.browse', auth()->guard('marketer')->user()->browse_code)}}' , '_blank')"
                   class="btn btn-sm btn-outline-success" value="اذهب للرابط"/>

            <input type="text" class="d-none"
                   value="{{ route('front.affiliate.browse', auth()->guard('marketer')->user()->browse_code) }}">
            <button class="btn btn-outline-orange btn-sm" onclick="myFunction(this)">انسخ الرابط</button>

        </div>
        <br>
        <h3>المبلغ الكلي : {{ number_format(auth()->guard('marketer')->user()->orders_sum_total) }}  ريال </h3>



    </div>
    </div>

@endsection

@section('content')
@endsection

@section('js')
@endsection
