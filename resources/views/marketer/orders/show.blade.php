@extends('marketer.layout')

@section('title', "طلب " . @$order->name_ar)
@section('title_page',   "طلب " . @$order->name_ar )

@section('content')



    @if($order)
        <div class="container w-75">

            <a href="{{route('marketer.orders.index')}}" class="btn btn-primary">رجوع</a>

            <div class="row   m-1 p-5"
                 style="background-color: #ffee9a;   box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                <img class="d-block text-center m-auto" style="width: 100px; height: 100px; " width="100" height="100"
                     src="{{asset('client/img/logo.png')}}">
                <div class="row mt-3">


                    <h4 class="text-center">order No : {{  App\Helpers\OrderPublic::getCode($order)  }} </h4>
                </div>

                <div class="container">

                    <table class="table mt-5 pt-5" style="background-color: white">
                        <thead>


                        </thead>
                        <tbody>
                        <tr>

                            <td class="text-center pt-5">المجموع</td>
                            <td class="text-center pt-5">{{$order->total}}</td>

                        <tr>
                            <td class="text-center">الضريبة</td>
                            <td class="text-center">{{$order->tax}}</td>
                        </tr>
                        <tr>
                            <td class="text-center">الاجمالي</td>
                            <td class="text-center">{{$order->total + $order->tax}}</td>

                        </tr>
                        <td class="text-center">وسيلة الدفع</td>
                        <td class="text-center"> {{optional(@$order->payment)->name}} </td>

                        <tr>
                            <td class="text-center">اسم المسوق</td>
                            <td class="text-center"> {{optional(@$order->marketer)->name}}</td>
                        </tr>
                        <tr>
                            <td class="text-center">حالة الطلب</td>
                            <td class="text-center">{{optional(@$order->order_status)->name_ar}}</td>
                        </tr>


                        </tbody>
                    </table>


                    <table class="table" style="background-color: white">
                        <thead>
                        <tr>
                            <th class="text-center" scope="col">المسجد</th>
                            <th class="text-center" scope="col">اسم عامل الدليفري</th>
                            <th class="text-center" scope="col">تاريخ الاسناد</th>

                            <th class="text-center" scope="col">تاريخ التوصيل</th>
                            <th class="text-center" scope="col">نوع خدمة التوصيل</th>
                            <th class="text-center" scope="col"> جوال عامل خدمة التوصيل</th>


                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="text-center">{{@$order->mosque->name}}</td>
                            <td class="text-center">{{$order->delivery_name}}</td>
                            <td class="text-center">{{$order->assigned_at}}</td>
                            <td class="text-center">{{@$order->delivered_at}}</td>
                            <td class="text-center">{{@$order->delivery_type->name}}</td>
                            <td class="text-center">{{$order->delivery_mobile}}</td>


                        </tr>
                        <tr>
                            <td class="text-center" colspan="2">ملاحظات</td>
                            <td colspan="4">
                                {{$order->notes}}
                            </td>
                        </tr>


                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    @endif
@endsection
