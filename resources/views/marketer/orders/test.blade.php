@extends('marketer.layout')

@section('title', "طلب " . @$order->name_ar)
@section('title_page',   "طلب " . @$order->name_ar )

@section('content')



    <div class="container w-75">


        <div class="row   m-5 p-5"
             style="background-color: #ffee9a;   box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            <img class="d-block text-center m-auto" style="width: 100px; height: 100px; " width="100" height="100"
                 src="{{asset('client/img/logo.png')}}">
            <div class="row mt-3">


                <h4 class="text-center">order No : 123 </h4>
            </div>

            <div class="container">

                <table class="table mt-5" style="background-color: white">
                    <thead>
                    <tr>

                        <th class="text-center p-4" scope="col">المجموع</th>
                        <th class="text-center p-4" scope="col">الضريبة</th>

                    </tr>


                    </thead>
                    <tbody>
                    <tr>

                        <td class="text-center">المجموع</td>
                        <td class="text-center">المجموع</td>

                    <tr>
                        <td class="text-center">الضريبة</td>
                        <td class="text-center">الضريبة</td>
                    </tr>
                    <tr>
                        <td class="text-center">الاجمالي</td>
                        <td class="text-center">الاجمالي</td>

                    </tr>
                        <td class="text-center">وسيلة الدفع</td>
                    <td class="text-center">وسيلة الدفع</td>

                    <tr>
                        <td class="text-center">الاجمالي</td>
                        <td class="text-center">الاجمالي</td>
                    </tr>
                    <tr>
                        <td class="text-center">التاريخ</td>
                        <td class="text-center">التاريخ</td>
                    <tr>
                        <td class="text-center">ملاحظات</td>
                        <td class="text-center">ملاحظات</td>
                    </tr>


                    </tbody>
                </table>


                <table class="table" style="background-color: white">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">المجموع</th>
                        <th scope="col">الضريبة</th>
                        <th scope="col">الاجمالي</th>

                        <th scope="col">وسيلة الدفع</th>
                        <th scope="col">التاريخ</th>
                        <th scope="col">حالة الطلب</th>
                        <th scope="col">التاريخ</th>
                        <th scope="col">ملاحظات</th>


                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td>Mark</td>
                        <td>Otto</td>


                    </tr>


                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection
