@extends('admin.layout')

@section('title',  "تقارير الدخل اليومي للمنتجات")
@section('title_page', "تقارير الدخل اليومي للمنتجات")


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
                        <form action="{{route('admin.products_daily_income.reports.index')}}" method="get">
                            <div class="row mb-3">
                                <div class="col-md-2 mb-2">
                                    <select
                                            name="product_name"   class="form-control">
                                        <option value=""> اختر منتج </option>
                                        @foreach(\App\Models\Product::get() as $product)
                                        <option {{  request()->input('product_name') == $product->id ? 'selected' : ''  }} value="{{$product->id}}">{{$product->name_ar}} </option>
                                    @endforeach
                                    </select>
                                </div>

                                <div class="row">

                                    <!------------------->

                                    <div class="col-md-2 mb-2">
                                        <div class="col">
                                            <label class="form-label "><small> من تاريخ</small></label>
                                        </div>

                                        <div class="col">
                                            <input type="date" value="{{  request()->input('from_date') }}"
                                                   name="from_date" placeholder="من تاريخ" class="form-control col">
                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-2">
                                        <div class="col">
                                            <label class="form-label  "><small>الي تاريخ</small></label>
                                        </div>

                                        <div class="col">
                                            <input type="date" value="{{   request()->input('to_date') }}"
                                                   name="to_date" placeholder="الي تاريخ" class="form-control  ">
                                        </div>
                                    </div>


                                    <div class="search-input col-md-2">
                                        <br>
                                        <button class="btn btn-primary btn-sm" type="submit">
                                            <i class="fas fa-search"> </i>
                                        </button>

                                        <a class="btn btn-success btn-sm"
                                           href="{{route('admin.products_daily_income.reports.index')}}"><i
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
                                    <th>الاسم</th>


                                    @foreach($dateRange as $date)
                                        <th class="px-4 py-2">{{$date->format('Y-m-d')}}</th>
                                    @endforeach

                                </tr>
                                </thead>
                                <tbody>


                                @foreach ($items as $productName =>  $data)
                                    <tr>

                                        <td>{{\App\Models\Product::where('id', $productName)->first()->name_ar}}</td>
                                        @foreach($dateRange as $date)
                                            <td>{{$data->where('date' , $date->format('Y-m-d'))->first()->total??0 }}  ريال </td>
                                        @endforeach
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
