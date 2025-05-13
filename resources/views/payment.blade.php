@extends('layouts.app')
@section('title')
@endsection
@section('css')
    <style>
        .drop_box {
            margin: 10px 0;
            padding: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            border: 3px dotted #a3a3a3;
            border-radius: 5px;
            width: 100%;
        }

        .drop_box h4 {
            font-size: 16px;
            font-weight: 400;
            color: #2e2e2e;
        }

        .drop_box p {
            margin-top: 10px;
            margin-bottom: 20px;
            font-size: 12px;
            color: #a3a3a3;
        }

        

        
    </style>
@endsection
@section('skeleton')
@endsection
@section('content')
    <main class="main-wrap payment-page mb-xxl">
        <div class="steps">
            <ul>
                <li class="selected">
                    <span class=""><i class="ri-check-line"></i></span>
                    <strong class="">المسجد</strong>
                </li>
                <li class="selected">
                    <span><i class="ri-check-line"></i></span>
                    <strong>الكمية</strong>
                </li>
                <li class="selected"><span>3</span>
                    <strong>الدفع</strong>
                </li>
                <li><span>4</span>
                    <strong>التأكيد</strong>
                </li>
            </ul>
        </div>
        <section class="location-section py-0">
            <div class="">
                <h3 class="title-color font-sm">التأكيد والدفع</h3>
                <p class="content-color font-sm">يرجى مراجعة الطلب قبل الدفع</p>
            </div>
        </section>
        <!-- Payment Section Start -->
        <section class="payment-section py-0">
            <!-- Payment Method Accordian Start -->
            <div class="accordion" id="accordionExample">
                <!-- Accordion Start -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button font-md title-color" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            بطاقة ائتمانية / مدى
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="offcanvas-body small">
                                <form class="custom-form">
                                    <div class="input-box">
                                        <input type="text" placeholder="الاسم على البطاقة" class="form-control" />
                                    </div>
                                    <div class="input-box">
                                        <input type="number" placeholder="رقم البطاقة " class="form-control" />
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="input-box mb-0">
                                                <i class="iconly-Calendar icli"></i>
                                                <input class="datepicker-here form-control digits expriydate" type="text"
                                                    data-language="en" data-multiple-dates-separator=", "
                                                    placeholder="تاريخ الانتهاء" />
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-box mb-0">
                                                <input type="number" placeholder="رمز التحقق" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Accordion End -->

                <!-- Accordion Start -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button font-md title-color collapsed" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                            aria-controls="collapseTwo">
                            تحويل بنكي
                        </button>
                    </h2>

                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body net-banking">
                            <div class="row">
                                <!-- Net Banking Option Start -->
                                <div class="col-12">
                                    <p class="mb-3">فضلاً حدد البنك</p>
                                </div>
                                <div class="input-box col-12">
                                    <select name="" class="select-control" style="width: 100%">
                                        <option>البنك الأهلي التجاري</option>
                                        <option>مصرف الراجحي</option>
                                        <option>بنك البلاد</option>
                                        <option> مصرف الإنماء</option>
                                    </select>
                                </div>
                                <!-- Net Banking Option End -->

                                <!-- Net Banking Option Start -->
                                <div class="input-box col-12">

                                    <div class="drop_box">
                                        <header>
                                            <h4>أرفق صورة إيصال الحوالة</h4>
                                        </header>
                                        <p>الملفات المدعومة: PDF, JPG</p>
                                        <input type="file" hidden accept=".jpg,.jpeg,.pdf" id="fileID"
                                            style="display:none;">
                                        <button class="btn">اختر ملف</button>
                                    </div>

                                </div>
                                <!-- Net Banking Option End -->

                                <div class="col-12">
                                    <div class=""
                                        style="border: 1px solid #a5e3fb;background-color: #e9f9ff;border-radius: 12px;padding: 10px;width: 100%;margin:0 20px;">
                                        <div class="col-12 mb-3">
                                            <h3>البنك الأهلي التجاري</h3>
                                        </div>
                                        <div class="col-12 mb-1">
                                            المستفيد: شركة رؤية المستقبل للتجارة
                                        </div>
                                        <div class="col-12 mb-1">
                                            <div class="row">
                                                <div class="col-10" style="width:unset">رقم الحساب: 4505454787870</div>
                                                <div class="col-2" style="width:unset"><i class="ri-file-copy-2-line"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-1">
                                            <div class="row">
                                                <div class="col-10" style="width:unset">رقم الآيبان: SA124004505454787870
                                                </div>
                                                <div class="col-2" style="width:unset"><i class="ri-file-copy-2-line"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <!-- Accordion End -->


            </div>
            <!-- Payment Method Accordian End -->
        </section>
        <!-- Payment Section End -->

        <!-- Order Detail Start -->
        <section class="order-detail">
            <h3 class="title-2">مكان التوصيل</h3>
            <!-- Product Detail  Start -->
            <ul>
                <li>
                    <span>مسجد زيد بن حارثة - مكة</span>
                </li>
            </ul>
            <div class="input-box col-6 my-3">
                <input type="radio" name="radio10" id="radio10" value="option1" checked="">
                <label class="form-check-label" for="radio10">توصيل مباشر للمسجد </label>
            </div>
            <div class="input-box col-6 my-3">
                <input type="radio" name="radio10" id="radio11" value="option1">
                <label class="form-check-label" for="radio11">تسليم شخص معين </label>
            </div>
            <div class="col-12 mt-3" id="man">
                <form class="custom-form">


                    <div class="row">
                        <div class="col-12 mb-2">
                            <div class="input-box mb-0">
                                <input class=" form-control" type="text" placeholder="اسم المستلم" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-box mb-0">
                                <input type="number" placeholder="رقم الجوال" class="form-control" />
                            </div>
                        </div>
                        <div class="col-12 my-2">
                            <div class="alert alert-warning" role="alert">
                                <i class="ri-alert-line"></i> ملاحظة: في حال لم يرد الشخص على اتصالات المندوب سيتم توصيل
                                المياه للمسجد مباشرة، وذلك بعد التنسيق معكم ومتابعتكم.
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Product Detail  End -->
        </section>
        <section class="order-detail mt-3">
            <h3 class="title-2">تفاصيل الطلب</h3>
            <!-- Product Detail  Start -->
            <ul>
                <li>
                    <span>20 كرتون ماء</span>
                    <span>340.00</span>
                </li>

                <li>
                    <span>رسوم التوصيل</span>
                    <span>25.00</span>
                </li>

                <li>
                    <span>الضريبة 15% </span>
                    <span>54.75</span>
                </li>
                <li>
                    <span>الإجمالي</span>
                    <span>419.75</span>
                </li>

            </ul>
            <p class="my-3 text-center">رقم التسجيل الضريبي: 311215850700003 </p>
            {{-- <div class=" input-box my-2">
                
                
                

            </div> --}}
            <!-- Product Detail  End -->

        </section>
        {{-- <div class="m-2"> --}}
        <div class="input-box m-2 my-3">
            <label class="form-check-label" for="radio13"><input type="checkbox" name="radio13" id="radio13"
                    value="option1"> قرأت وأوافق على <a class="url_link" href="#">الشروط والأحكام</a> و<a
                    class="url_link" href="#">سياسة الخصوصية</a> لمنصة قطرة. </label>
        </div>
        <!-- Order Detail End -->
    </main>
    <footer class="footer-wrap footer-button">
        <a href="{{ route('order-success') }}" class="font-md">تأكيد الدفع</a>
    </footer>
@endsection
@section('js')
    <script>
        $("#layout_footer").hide();
        $("#man").hide();
        $("#radio10").on("click", function() {
            $("#man").hide();
        })
        $("#radio11").on("click", function() {
            $("#man").show();
        })
    </script>
@endsection
