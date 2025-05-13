@extends('admin.layout')

@section('title',  "تقارير العملاء")
@section('title_page', "تقارير العملاء")


@section('content')

    <div class="container-fluid">

        {{--showProduct*--}}
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body  search-group">




                        {{--                        customer_name--}}
                        {{--                        customer_mobile--}}
                        {{--                        customer_email--}}
                        {{--                        from_price--}}
                        {{--                        to_price--}}
                        {{--                        from_date--}}
                        {{--                        to_date--}}
                        {{-- Start Form search --}}
                        <form action="{{route('admin.clients.reports.index')}}" method="get">
                            <div class="row mb-3">
                                <div class="col-md-2 mb-2">
                                    <input type="text" value="{{ old('name', request()->input('name')) }}" name="name" placeholder="ابحث باسم العميل" class="form-control">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <input type="text" value="{{ old('mobile', request()->input('mobile')) }}" name="mobile" placeholder="ابحث بجوال العميل" class="form-control">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <input type="text" value="{{ old('email', request()->input('email')) }}" name="email" placeholder="ابحث بايميل العميل" class="form-control">
                                </div>

                                <div class="row">

                                <!------------------->

                                    <div class="col-md-2 mb-2">
                                        <div class="col">
                                            <label class="form-label "><small> من تاريخ</small></label>
                                        </div>

                                        <div class="col">
                                            <input type="date" value="{{  request()->input('from_date') }}" name="from_date" placeholder="من تاريخ" class="form-control col">
                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-2">
                                        <div class="col">
                                            <label class="form-label  "><small>الي تاريخ</small></label>
                                        </div>

                                        <div class="col">
                                            <input type="date" value="{{   request()->input('to_date') }}" name="to_date" placeholder="الي تاريخ" class="form-control  ">
                                        </div>
                                    </div>






                                    <div class="search-input col-md-2">
                                        <br>
                                        <button class="btn btn-primary btn-sm" type="submit">
                                            <i class="fas fa-search"> </i>
                                        </button>

                                        <a class="btn btn-success btn-sm" href="{{route('admin.clients.reports.index')}}"><i
                                                class="refresh ion ion-md-refresh"></i></a>

                                    </div>
                                </div>

                            </div>
                        </form>
                        {{-- End Form search --}}


                        {{--                        <div>--}}

                        {{--                            <div class="row">--}}
                        {{--                                <div class="search-input col-md-2 mt-4">--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}

                        {{--                        </div>--}}
                        {{-- End Form search --}}
                    </div>


                    <div class="card-body mt-0 pt-0">
                        <div>
                        </div>
                        <div class="table-responsive">
                            <table id="main-datatable"
                                   class="table table-bordered  dt-responsive nowrap table-striped table-table-success table-hover"
                                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                <thead>
                                <tr class="bluck-actions" style="display: none" scope="row">
                                    <td colspan="8">
                                    </td>

                                </tr>


                                <tr>
                                    <th>#</th>


                                    <th>الالسم</th>
                                    <th>الايميل</th>
                                    <th>الجوال</th>

                                    <th>عدد اجمالي الطلبات</th>
                                    <th>المبلغ الكلي للطلبات</th>



                                    <th>الاجرائات</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($items as $key =>  $item)
                                    <tr>
                                        <td>{{ 1 + $key }}</td>


                                        <td>
                                            {{ $item->name}}
                                        </td>

                                        <td>  {{ $item->email}}</td>
                                        <td>
                                            {{ $item->mobile}}
                                        </td>
                                        <td>
                                            {{ $item->all_count}}
                                        </td>
                                        <td>  {{ $item->all_total}} ريال </td>



                                        <td>
                                            <a class="btn btn-success" target="_blank"
                                               href="{{route('admin.orders.index') . '?customer_mobile=' . $item->mobile}}"
                                            >تفاصيل</a>
                                        </td>


                                    </tr>


                                @endforeach

                                </tbody>


                            </table>
                        </div>


                        </form>
                    </div>

                </div>

            </div>

        </div> <!-- container-fluid -->

@endsection


@section('script')
    {{-- @vite(['resources/assets/admin/js/data-tables.js']) --}}
@endsection
