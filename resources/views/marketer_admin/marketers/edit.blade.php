@extends('marketer_admin.layout')

@section('title')
    تعديل مسوق
@endsection
@section('css')
@endsection
@section('breadcrumb')
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light"> نظام قطرة /</span><span class="text-muted fw-light">إدارة المسوقين /</span>
        تعديل مسوق
    </h4>
@endsection
@section('content')


    <div class="card mb-4">

        <h5 class="card-header">تعديل مسوق</h5>
        <div style="text-align: left; margin-left: 10px">
            <div type="button" class="btn btn-primary  ml-0" style="width: 100px; " data-bs-toggle="modal"
                 data-bs-target="#myModal">
                اضف كوبون جديد
            </div>
        </div>


{{--        <div class="card-body" action="{{ route('marketer_admin.marketer.update',$marketer->id) }}" method="POST">--}}
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-12">
                    <h4 class="mt-4 mb-0">معلومات عامة</h4>
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="collapsible-fullname">اسم المسوق</label>
                    <input type="text" name="name" disabled value="{{ old('name',$marketer->name) }}"
                           class="form-control @error('name') is-invalid @enderror" placeholder="اسم المسوق"/>
                    @error('name')
                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="collapsible-fullname">رقم الجوال</label>
                    <input type="number" disabled name="mobile" value="{{ old('mobile',$marketer->mobile) }}"
                           class="form-control @error('mobile') is-invalid @enderror" placeholder="9665XXXXXXXX"/>
                    @error('mobile')
                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="collapsible-fullname">البريد الالكتروني</label>
                    <input type="email" disabled name="email" value="{{ old('email',$marketer->email) }}"
                           class="form-control @error('email') is-invalid @enderror" placeholder="البريد الالكتروني"/>
                    @error('email')
                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
{{--                    <button type="submit" class="btn btn-primary">حفظ</button>--}}
                    <a href="{{'/marketer_admin/marketers'}}"  class="btn btn-info">رجوع</a>

                </div>

            </div>
        </div>


        <!-- The Modal -->
        <div class="modal fade" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title"> اضف كوبون جديد </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">

                        <form method="post" action="{{route('marketer_admin.coupon.store')}}">
                            @csrf

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label"> كود  </label>
                                <input type="text" placeholder="هدخل الكود " class="form-control" id="exampleInputEmail1" name="code">
                                <div id="emailHelp" class="form-text"> ادخل كود غير متكرر من قبل</div>
                            </div>
                            <input name="marketer_id" value="{{$marketer->id}}" class="d-none">

                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">الكمية</label>
                                <input type="number" name="quantity" class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputproducts" class="form-label">المنتجات</label>
                                <select id="exampleInputproducts" multiple class="form-select form-select-sm form-control" name="products[]" >
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->name_ar}}</option>
                                    @endforeach
                                </select>

                            </div>

                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">submit</button>

                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">اغلاق</button>
                    </div>

                </div>
            </div>
        </div>


        @endsection
        @section('js')
            <script>

            </script>
@endsection
