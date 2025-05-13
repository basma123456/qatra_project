@extends('layouts.app')
@section('title')
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdn.moyasar.com/mpf/1.6.1/moyasar.css">
    <style>
        .account_box {
            border: 1px solid #a5e3fb;
            background-color: #e9f9ff;
            border-radius: 12px;
            padding: 10px;
            width: 100%;
            margin: 0;
        }

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

        #mysr-form-form-el#mysr-form-form-el#mysr-form-form-el.mysr-form-moyasarForm[payment-form=true] .mysr-form-label,
        #mysr-form-form-el#mysr-form-form-el#mysr-form-form-el.mysr-form-moyasarForm[payment-form=true] label.mysr-form-label {
            font-family: "SSTArabic", "sans-serif";
        }

        #mysr-form-form-el#mysr-form-form-el#mysr-form-form-el.mysr-form-moyasarForm[payment-form=true] input.mysr-form-input,
        #mysr-form-form-el#mysr-form-form-el#mysr-form-form-el.mysr-form-moyasarForm[payment-form=true] input.mysr-form-input[type=text] {
            font-family: "SSTArabic", "sans-serif";
            font-size: 14px;
        }

        #mysr-form-form-el#mysr-form-form-el#mysr-form-form-el.mysr-form-moyasarForm[payment-form=true] .mysr-form-button {
            font-family: "SSTArabic", "sans-serif";
            background-color: #4667ac;
        }

        #mysr-form-form-el#mysr-form-form-el#mysr-form-form-el.mysr-form-moyasarForm[payment-form=true] *,
        #mysr-form-form-el#mysr-form-form-el#mysr-form-form-el.mysr-form-moyasarForm[payment-form=true] *::before,
        #mysr-form-form-el#mysr-form-form-el#mysr-form-form-el.mysr-form-moyasarForm[payment-form=true] *::after {
            font-family: "SSTArabic", "sans-serif";
        }

        #mysr-form-form-el#mysr-form-form-el#mysr-form-form-el.mysr-form-moyasarForm[payment-form=true] .mysr-form-button:hover {
            background-color: #4667ac;
        }
    </style>
@endsection
@section('content')
    <main class="main-wrap payment-page mb-xxl">
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
                                <div class="custom-form">
                                    {!! $payment_form !!}
                                </div>
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
                            <form action="{{ route('front.payment.transfer', $order->id) }}" id="form_3" method="POST" enctype="multipart/form-data">
                                @include("front.messages")
                                @csrf
                                <div class="row">
                                    <!-- Net Banking Option Start -->
                                    <div class="col-12">
                                        <p class="mb-3">فضلاً حدد البنك</p>
                                    </div>
                                    <div class="input-box col-12">
                                        <select name="bank_id" class="select-control" style="width: 100%">
                                            @foreach ($banks as $bank)
                                                <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                            @endforeach
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
                                            <input id="transfer_img" type="file" hidden accept=".jpg,.jpeg,.pdf,.png"
                                                style="display:none;" name="transfer_img">
                                            <button id="btn_upload" class="btn">اختر ملف</button>
                                        </div>

                                    </div>
                                    <!-- Net Banking Option End -->
                                    @foreach ($banks as $bank)
                                        <div class="col-12 mb-3">
                                            <div class="row account_box">
                                                <div class="col-12 mb-3">
                                                    <h3>{{ $bank->name }}</h3>
                                                </div>
                                                <div class="col-12 mb-1">
                                                    المستفيد: {{ $bank->account_name }}
                                                </div>
                                                <div class="col-12 mb-1">
                                                    <div class="row">
                                                        <div class="col-10" style="width:unset">رقم الحساب:
                                                            {{ $bank->account_no }}</div>
                                                        <div class="col-2" style="width:unset">
                                                            <button type="button" class="btn"><i
                                                                    onclick="copyToClipboard('{{ $bank->account_no }}')"
                                                                    class="ri-file-copy-2-line"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 mb-1">
                                                    <div class="row">
                                                        <div class="col-10" style="width:unset">رقم الآيبان:
                                                            {{ $bank->iban }}
                                                        </div>
                                                        <div class="col-2" style="width:unset">
                                                            <button type="button" class="btn"><i
                                                                    onclick="copyToClipboard('{{ $bank->iban }}')"
                                                                    class="ri-file-copy-2-line"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <footer class="footer-wrap footer-button">
                                    <button type="button" id="submit_form" href="{{ route('order-success') }}" class="font-md"><span
                                            class="text-white">تأكيد
                                        </span></a>
                                </footer>
                            </form>


                        </div>
                    </div>
                </div>
                <!-- Accordion End -->


            </div>
            <!-- Payment Method Accordian End -->
        </section>
    </main>
    <div class="offcanvas offcanvas-bottom addtohome-popup notification-popup" tabindex="-1" id="notification-popup">
        <div class="offcanvas-body small">
            <div class="app-info">
                <div class="content">
                    <h3>تنبيه <i data-feather="x" data-bs-dismiss="offcanvas"></i></h3>
                </div>
            </div>
            <p class="my-2" id="notification-text"></p>
            <button class="btn-solid install-app" data-bs-dismiss="offcanvas">إغلاق</button>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $("#layout_footer").hide();
        $('#btn_upload').click(function() {
            $('#transfer_img').click();
            return false;
        });
        $('#submit_form').click(function() {
            // alert("submit_form");
            var flag = true;
            var msg = "";            
            if ($('#transfer_img').get(0).files.length === 0) {
                msg = "يجب ارفاق صورة إيصال الحوالة";
                flag = false;
            }



            if (flag) {
                $("#form_3").submit();
            }else{
                $("#notification-text").html(msg);
                var myOffcanvas = document.getElementById('notification-popup')
                var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas)
                bsOffcanvas.show()
            }

        });

        function copyToClipboard(text) {
            var sampleTextarea = document.createElement("textarea");
            document.body.appendChild(sampleTextarea);
            sampleTextarea.value = text; //save main text in it
            sampleTextarea.select(); //select textarea contenrs
            document.execCommand("copy");
            document.body.removeChild(sampleTextarea);
        }
    </script>
@endsection
