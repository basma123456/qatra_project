@extends('client.app')

@section('style')
    <style>
        .badge {
            text-transform: lowercase;
        }

        .same_h{
            height: 29px !important;
        }

    </style>

@endsection


@section('content')

    <style>
        .badge {
            text-transform: lowercase;
        }
    </style>

    <br>
    <div class="container">
    <div class="row">
        <div class="col-sm-6 col-xl-3">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>إجمالي الطلبات خلال اليوم</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">{{$total_day }}</h4>
                            </div>
                            <small>ريال</small>
                        </div>
                        <span class="badge bg-label-primary rounded p-2">
                            <i class="bx bx-customize bx-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>إجمالي الطلبات خلال أسبوع</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">{{ $total_week }}</h4>
                            </div>
                            <small>ريال</small>
                        </div>
                        <span class="badge bg-label-primary rounded p-2">
                            <i class="bx bx-customize bx-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>إجمالي الطلبات خلال شهر</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">{{ $total_month }}</h4>
                            </div>
                            <small>ريال</small>
                        </div>
                        <span class="badge bg-label-primary rounded p-2">
                            <i class="bx bx-customize bx-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>إجمالي كل الطلبات</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">{{ $total_all }}</h4>
                            </div>
                            <small>ريال</small>
                        </div>
                        <span class="badge bg-label-primary rounded p-2">
                            <i class="bx bx-customize bx-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="card">
        <h5 class="card-header">تفاصيل مسوق</h5>
        <div class="row mx-2 mb-4">
            <div class="col-md-12">
                <div class="mb-2">
                    <span class="badge bg-light text-dark rounded-pill me-1">اسم المسوق</span>
                    <span class="badge bg-light text-dark rounded-pill me-1">{{ $marketer->name }}</span>
                </div>
                <div class="mb-2">
                    <span class="badge bg-light text-dark rounded-pill me-1">رابط التسويق</span>
                    <span
                        class="badge bg-light text-dark rounded-pill me-1">{{ route('front.affiliate', $marketer->affiliate_code) }}</span>

                    <input type="button" onclick="window.open('{{route('front.affiliate', $marketer->browse_code)}}' , '_blank')" class="btn btn-sm btn-outline-success" value="اذهب للرابط"    />

                    <input type="text" class="d-none" value="{{ route('front.affiliate', $marketer->browse_code) }}" >
                    <button class="btn btn-outline-primary btn-sm" onclick="myFunction(this)">انسخ الرابط</button>

                </div>
                <div>
                    <span class="badge bg-light text-dark rounded-pill me-1">رابط الاستعراض</span>
                    <span
                        class="badge bg-light text-dark rounded-pill me-1">{{ route('front.affiliate.browse', $marketer->browse_code) }}</span>
                    <input type="button" onclick="window.open('{{route('front.affiliate.browse', $marketer->browse_code)}}' , '_blank')" class="btn btn-sm btn-outline-success" value="اذهب للرابط"    />


                    <input type="text" class="d-none" value="{{ route('front.affiliate.browse', $marketer->browse_code) }}" >
                    <button class="btn btn-outline-primary btn-sm" onclick="myFunction(this)">انسخ الرابط</button>

                </div>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>رقم الطلب</th>
                        <th>اسم المسجد</th>
                        <th>الحي</th>
                        <th>المبلغ</th>
                        <th>التاريخ</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td><strong>{{ @$order->mosque->name }}</strong></td>
                            <td><strong>{{ @$order->mosque->district->name }}</strong></td>

                            <td>{{ $order->total }}</td>
                            <td>{{ $order->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="min-height: 100px;">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
    </div>
@endsection


@section('script')
    <script>
        function myFunction(copyText) {
            // Get the text field
            // var copyText = document.getElementById("myInput");
            // Select the text field
            copyText.previousElementSibling.select();
            copyText.previousElementSibling.setSelectionRange(0, 99999); // For mobile devices

            // Copy the text inside the text field
            navigator.clipboard.writeText(copyText.previousElementSibling.value);

            // Alert the copied text
            alert("تم نسخ الرابط : " + copyText.previousElementSibling.value);
        }
    </script>

{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>--}}
    <!--select2-->
@endsection
