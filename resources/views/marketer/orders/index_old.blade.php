@extends('marketer.layout')

@section('name_ar', "الطلبات")
@section('name_ar_page',  "الطلبات")


@section('content')



    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body  search-group">
                        <div class="row">
                            <div class="col-md-12 text-end mb-2">
                                {{--                                <a href="#" class="btn btn-outline-success btn-sm">انشاء</a>--}}
                            </div>
                        </div>

                        {{-- Start Form search --}}
                        <form action="{{route('marketer.orders.index.old')}}" method="get">
                            @csrf
                            <div class="row mb-3">


                                <div class="col-md-2 mb-2">
                                    <input type="text"
                                           value="{{ old('mosque_name_ar', request()->input('mosque_name_ar')) }}"
                                           name="mosque_name_ar" placeholder="ابحث mosque_name_ar" class="form-control">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <input type="text"
                                           value="{{ old('delivery_type_name', request()->input('delivery_type_name')) }}"
                                           name="delivery_type_name" placeholder="ابحث delivery_type_name"
                                           class="form-control">
                                </div>


                                {{--                                <div class="col-md-2 mb-2">--}}
                                {{--                                    <input type="text"--}}
                                {{--                                           value="{{ old('payment_type_name', request()->input('payment_type_name')) }}"--}}
                                {{--                                           name="payment_type_name" placeholder="ابحث payment_type_name"--}}
                                {{--                                           class="form-control">--}}
                                {{--                                </div>--}}
                                <div class="col-md-2 mb-2">
                                    <select
                                        name="payment_type_id"
                                        class="form-control">
                                        <option value="">اختر طريقة الدفع</option>
                                        @forelse($paymentMethods as $payment_method)
                                            <option value="{{$payment_method->id}}" {{  (int)request()->input('payment_type_id') == $payment_method->id ? 'selected' : ''}} > {{ $payment_method->name_ar  }}</option>
                                        @empty

                                        @endforelse

                                    </select>
                                </div>


                                <div class="col-md-2 mb-2">
                                    <select
                                        name="order_status_id"
                                        class="form-control">
                                        <option value="">اختر   حالة الطلب </option>
                                        @foreach($orderStatus as $order_status)
                                            <option value="{{$order_status->id}}" {{  (int)request()->input('order_status_id') == $order_status->id ? 'selected' : ''}} > {{ $order_status->name_ar  }}</option>
                                        @endforeach

                                    </select>
                                </div>



                                {{--                                <div class="col-md-2 mb-2">--}}
                                {{--                                    <input type="text"--}}
                                {{--                                           value="{{ old('order_status_name', request()->input('order_status_name')) }}"--}}
                                {{--                                           name="order_status_name" placeholder="ابحث order_status_name"--}}
                                {{--                                           class="form-control">--}}
                                {{--                                </div>--}}

                                <div class="col-md-2 mb-2">
                                    <label>من تاريخ الاسناد</label>
                                    <input type="date"
                                           value="{{ old('assigned_at_from', request()->input('assigned_at_from')) }}"
                                           name="assigned_at_from" placeholder="ابحث assigned_at_from"
                                           class="form-control">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label>الي تاريخ الاسناد</label>
                                    <input type="date"
                                           value="{{ old('assigned_at_to', request()->input('assigned_at_to')) }}"
                                           name="assigned_at_to" placeholder="ابحث assigned_at_to" class="form-control">
                                </div>


                                <div class="col-md-2 mb-2">
                                    <input type="text" value="{{ old('total_from', request()->input('total_from')) }}"
                                           name="total_from" placeholder="ابحث total_from" class="form-control">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <input type="text" value="{{ old('total_to', request()->input('total_to')) }}"
                                           name="total_to" placeholder="ابحث total_to" class="form-control">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <input type="text" value="{{ old('tax_from', request()->input('tax_from')) }}"
                                           name="tax_from" placeholder="ابحث tax_from" class="form-control">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <input type="text" value="{{ old('tax_to', request()->input('tax_to')) }}"
                                           name="tax_to" placeholder="ابحث tax_to" class="form-control">
                                </div>

                                <div class="col-md-2 mb-2">
                                    <input type="text"
                                           value="{{ old('gift_sender_name', request()->input('gift_sender_name')) }}"
                                           name="gift_sender_name" placeholder="ابحث gift_sender_name"
                                           class="form-control">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <input type="text"
                                           value="{{ old('gift_recipient_name', request()->input('gift_recipient_name')) }}"
                                           name="gift_recipient_name" placeholder="ابحث gift_recipient_name"
                                           class="form-control">
                                </div>


                                <div class="col-md-2 mb-2">
                                    <input type="text"
                                           value="{{ old('gift_recipient_mobile', request()->input('gift_recipient_mobile')) }}"
                                           name="gift_recipient_mobile" placeholder="ابحث gift_recipient_mobile"
                                           class="form-control">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <input type="text"
                                           value="{{ old('delivery_mobile', request()->input('delivery_mobile')) }}"
                                           name="delivery_mobile" placeholder="ابحث delivery_mobile"
                                           class="form-control">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <input type="text"
                                           value="{{ old('gift_recipient_name', request()->input('gift_recipient_name')) }}"
                                           name="gift_recipient_name" placeholder="ابحث gift_recipient_name"
                                           class="form-control">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <input type="text"
                                           value="{{ old('delivery_name', request()->input('delivery_name')) }}"
                                           name="delivery_name" placeholder="ابحث delivery_name" class="form-control">
                                </div>


                                {{--                                <div class="col-md-2 mb-2">--}}
                                {{--                                    <select class="form-select" name="status"  aria-label=".form-select-sm example">--}}
                                {{--                                        <option selected value=""> الحالة  </option>--}}
                                {{--                                        <option value="1"{{ old('status', request()->input('status')) == 1? "selected":"" }}> نشط </option>--}}
                                {{--                                        <option value="0" {{ old('status', request()->input('status')) != 1 && old('status', request()->input('status')) != null? "selected":"" }}> غير نشط </option>--}}
                                {{--                                    </select>--}}
                                {{--                                </div>--}}

                                <div class="search-input col-md-2">
                                    <button class="btn btn-primary btn-sm" type="submit"><i class="fas fa-search"> </i>
                                    </button>
                                    <a class="btn btn-success btn-sm" href="{{route('marketer.orders.index.old')}}"><i
                                            class="refresh ion ion-md-refresh"></i></a>
                                </div>
                            </div>
                        </form>
                        {{-- End Form search --}}
                    </div>


                    <div class="card-body mt-0 pt-0">

                        <div class="table-responsive">
                            <table id="main-datatable"
                                   class="table table-bordered  dt-responsive nowrap table-striped table-table-success table-hover"
                                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                <thead>
                                <tr class="bluck-actions" style="display: none" scope="row">
                                    <td colspan="8">
                                        {{--                                        <div class="col-md-12 mt-0 mb-0 text-center">--}}
                                        {{--                                            <button form="update-pages" class="btn btn-success btn-sm" type="submit"--}}
                                        {{--                                                    name="publish" value="1"><i class="fa fa-check"></i></button>--}}
                                        {{--                                            <button form="update-pages" class="btn btn-warning btn-sm" type="submit"--}}
                                        {{--                                                    name="unpublish" value="1"><i class="fa fa-ban"></i></button>--}}
                                        {{--                                            <button form="update-pages" class="btn btn-danger btn-sm" type="submit"--}}
                                        {{--                                                    name="delete_all" value="1"><i class="fas fa-trash-alt"></i>--}}
                                        {{--                                            </button>--}}
                                        {{--                                        </div>--}}
                                    </td>

                                </tr>
                                <tr>
                                    <th style="width: 1px">
                                        <input form="update-pages" class="checkbox-check flat" type="checkbox"
                                               name="check-all" id="check-all">
                                    </th>
                                    <th>#</th>
                                    <th> رقم الطلب</th>
                                    <th> المبلغ الكلي</th>
                                    <th> تاريخ الانشاء</th>
                                    <th> تاريخ الاسناد</th>
                                    <th> تاريخ التوصيل</th>

                                    <th> الاجرائات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($items as $key => $item)
                                    @if($item)
                                        <tr>
                                            <td>
                                                <input form="update-pages" class="checkbox-check" type="checkbox"
                                                       name="record[{{$item->id}}]" value={{ $item->id }}>
                                            </td>
                                            <td>{{   $key  + 1 }}</td>
                                            <td>
                                                {{  App\Helpers\OrderPublic::getCode($item)}}
                                            </td>
                                            <td>
                                                {{--                                        {{ substr(removeHTML($item->description_ar),0,30)   }}--}}
                                                {{  $item->total }}

                                            </td>

                                            <td>                    {{ date('Y-m-d', strtotime($item->created_at)) }}</td>
                                            <td>                    {{ date('Y-m-d', strtotime($item->assigned_at)) }}</td>
                                            <td>                    {{ date('Y-m-d', strtotime($item->delivered_at)) }}</td>

                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('marketer.orders.show', $item->id) }}"
                                                       name="@lang('marketer.show')"
                                                       class="btn btn-xs btn-outline-info btn-sm m-1"><i
                                                            class="fas fa-eye"></i></a>


                                                </div>
                                            </td>


                                        </tr>

                                    @endif

                                @endforeach

                                </tbody>


                            </table>
                        </div>


                        <div class="col-md-12 text-center">
                            {{--                            {{ $items->links() }}--}}
                        </div>

                        </form>
                    </div>

                </div>

            </div>

        </div> <!-- container-fluid -->
    </div>
@endsection


@section('script')
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script>
        window.livewire.on('toggleGalaxyFormModal', () => $('#galaxy-form-modal').modal('toggle'));
    </script>
@endsection
