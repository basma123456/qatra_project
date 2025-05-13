@extends('marketer.layout')

@section('title', "طلب " . @$order->name_ar)
@section('title_page',   "طلب " . @$order->name_ar )

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="row">
                <div class="col-12 m-3">
                    <div class="row mb-3 text-end">
                        <div>
                            <a href="{{ route('admin.orders.index') }}"
                               class="btn btn-outline-primary waves-effect waves-light ml-3 btn-sm">رجوع</a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div>

                                <div class="row">
                                    <div class="col-md-8">


                                        <div class="accordion mt-4 mb-4" id="accordionExample">
                                            <div class="accordion-item border rounded">
                                                <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button fw-medium" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                            aria-expanded="true" aria-controls="collapseOne">

                                                    </button>
                                                </h2>
                                                <div id="collapseOne" class="accordion-collapse collapse show mt-3"
                                                     aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">


                                                        {{-- name_ar ------------------------------------------------------------------------------------- --}}





                                                        {{-- slug ------------------------------------------------------------------------------------- --}}
                                                        {{-- Start Slug --}}
                                                        <div class="row mb-3 slug-section">

                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label"> المسجد </label>
                                                            <div class="col-sm-4">
                                                                <input class="form-control" type="text" name="name_ar"
                                                                       disabled value="{{ @$order->mosque->name }}"
                                                                       id="name_ar">
                                                            </div>


                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label"> اسم المسوق </label>

                                                            <div class="col-sm-4">
                                                                <input type="text" id="slug" name="slug"
                                                                       disabled value="{{ @$order->marketer->name }}"
                                                                       class="form-control slug mb-3" required>

                                                            </div>

                                                            {{-- End Slug --}}

                                                        </div>


                                                        <div class="row mb-3 slug-section">
                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label">وسيلة الدفع
                                                                  </label>
                                                            <div class="col-sm-4 mb-2">
                                                                <input class="form-control  mb-3" disabled
                                                                       value="{{ @$order->payment->name }}">
                                                            </div>


                                                            {{-- description ------------------------------------------------------------------------------------- --}}

                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label"> نوع خدمة
                                                                التوصيل </label>
                                                            <div class="col-sm-4 mb-2">
                                                                <input disabled class="form-control  mb-3"
                                                                       value="{{ @$order->delivery_type->name }}">
                                                            </div>

                                                        </div>


                                                        <div class="row mb-3 slug-section">
                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label"> اسم عامل خدمة
                                                                التوصيل </label>
                                                            <div class="col-sm-4 mb-2">
                                                                <input disabled class="form-control  mb-3"
                                                                       value="{{ @$order->delivery->name }}">
                                                            </div>


                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label"> جوال عامل خدمة
                                                                التوصيل </label>
                                                            <div class="col-sm-4 mb-2">
                                                                <input disabled class="form-control  mb-3"
                                                                       value="{{ @$order->delivery->mobile }}">
                                                            </div>
                                                        </div>




                                                        <div class="row mb-3 slug-section">
                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label"> assigned_at </label>
                                                            <div class="col-sm-4 mb-2">
                                                                <input disabled class="form-control  mb-3"
                                                                       value="{{ @$order->assigned_at }}">
                                                            </div>


                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label">
                                                                delivering_at </label>
                                                            <div class="col-sm-4 mb-2">
                                                                <input disabled class="form-control  mb-3"
                                                                       value="{{ @$order->delivering_at }}">
                                                            </div>
                                                        </div>


                                                        <div class="row mb-3 slug-section">
                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label">
                                                                delivered_at </label>
                                                            <div class="col-sm-4 mb-2">
                                                                <input disabled class="form-control  mb-3"
                                                                       value="{{ @$order->delivered_at }}">
                                                            </div>





                                                        </div>




                                                        <div class="row mb-3 slug-section">
                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label"> الملاحظات </label>
                                                            <div class="col-sm-10 mb-2">
                                                                    <textarea disabled class="form-control  mb-3"
                                                                              value="{{ @$order->note }}"> </textarea>
                                                            </div>


                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        {{--                                        /////////--}}

                                        @if(@$order->is_gift_card > 0)
                                        <div class="accordion mt-4 mb-4" id="accordionExample">
                                            <div class="accordion-item border rounded">
                                                <h2 class="accordion-header" id="headingTwo">
                                                    <button class="accordion-button fw-medium" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                            aria-expanded="true" aria-controls="collapseTwo">
                                                        اعدادات الميتا
                                                    </button>
                                                </h2>
                                                <div id="collapseTwo" class="accordion-collapse collapse show mt-3"
                                                     aria-labelledby="headingTwo"
                                                     data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">


                                                        {{-- meta_title_ ------------------------------------------------------------------------------------- --}}
{{--                                                        <div class="row mb-3">--}}
{{--                                                            <label for="example-text-input"--}}
{{--                                                                   class="col-sm-2 col-form-label"> عنوان ميتا </label>--}}
{{--                                                            <div class="col-sm-5">--}}
{{--                                                                <input class="form-control" type="text"--}}
{{--                                                                       name="meta_title"--}}
{{--                                                                       disabled value="{{ @$order->meta_title }}"--}}
{{--                                                                       id="name_ar">--}}
{{--                                                            </div>--}}
{{--                                                            @if ($errors->has( 'meta_title'))--}}
{{--                                                                <span--}}
{{--                                                                    class="missiong-spam">{{ $errors->first( 'meta_title') }}</span>--}}
{{--                                                            @endif--}}
{{--                                                        </div>--}}



                                                        <div class="row mb-3 slug-section">
                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label"> اسم المهدي </label>
                                                            <div class="col-sm-4 mb-2">
                                                                <input disabled class="form-control  mb-3"
                                                                       value="{{ @$order->gift_sender }}">
                                                            </div>


                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label"> اسم المهدي
                                                                اليه </label>
                                                            <div class="col-sm-4 mb-2">
                                                                <input disabled class="form-control  mb-3"
                                                                       value="{{ @$order->gift_recipent_name }}">
                                                            </div>
                                                        </div>


                                                        <div class="row mb-3 slug-section">
                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label"> جوال المهدي
                                                                اليه </label>
                                                            <div class="col-sm-4 mb-2">
                                                                <input disabled class="form-control  mb-3"
                                                                       value="{{ @$order->gift_recipent_mobile }}">
                                                            </div>


                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label"> تاريخ
                                                                الاهداء </label>
                                                            <div class="col-sm-4 mb-2">
                                                                <input disabled class="form-control  mb-3"
                                                                       value="{{ @$order->gift_sent_at }}">
                                                            </div>

                                                        </div>
                                                        <hr>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                            @endif
                                    </div>
                                    <div class="col-md-4">

                                        <div class="accordion mt-4 mb-4" id="accordionExample">
                                            <div class="accordion-item border rounded">
                                                <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button fw-medium" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                            aria-expanded="true" aria-controls="collapseOne">
                                                        الاعدادات
                                                    </button>
                                                </h2>
                                                <div id="collapseOne" class="accordion-collapse collapse show"
                                                     aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="col-sm-4 mb-3">


                                                        </div>

                                                        {{-- sort ------------------------------------------------------------------------------------- --}}
                                                        <div class="col-12">
                                                            <div class="row mb-3">
                                                                <label for="example-number-input" col-form-label>
                                                                    الكمية :</label>
                                                                <div class="col-sm-22">
                                                                    <input class="form-control" type="number"
                                                                           disabled
                                                                           id="example-number-input" name="sort"
                                                                           value="{{ @$order->amount }}">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="row mb-3">
                                                                <label for="example-number-input" col-form-label>
                                                                    المجموع :</label>
                                                                <div class="col-sm-22">
                                                                    <input class="form-control" type="number"
                                                                           disabled
                                                                           id="example-number-input" name="sort"
                                                                           value="{{ @$order->total }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="row mb-3">
                                                                <label for="example-number-input" col-form-label>
                                                                    الضريبة :</label>
                                                                <div class="col-sm-22">
                                                                    <input class="form-control" type="number"
                                                                           disabled
                                                                           id="example-number-input" name="sort"
                                                                           value="{{ @$order->tax }}">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="row mb-3">
                                                                <label for="example-number-input" col-form-label>
                                                                    حالة الطلب :</label>
                                                                <div class="col-sm-22">
                                                                    <input class="form-control" type="number"
                                                                           disabled
                                                                           id="example-number-input" name="sort"
                                                                           value="{{ @$order->order_status->name_ar }}">
                                                                </div>
                                                            </div>
                                                        </div>




                                                        <!--here-->



{{--                                                        <div class="row mb-3 slug-section">--}}
{{--                                                            <label for="example-text-input"--}}
{{--                                                                   class="col-sm-2 col-form-label"> المجموع </label>--}}
{{--                                                            <div class="col-sm-4 mb-2">--}}
{{--                                                                <input disabled class="form-control  mb-3"--}}
{{--                                                                       value="{{ @$order->total }}">--}}
{{--                                                            </div>--}}


{{--                                                            <label for="example-text-input"--}}
{{--                                                                   class="col-sm-2 col-form-label"> الضريبة </label>--}}
{{--                                                            <div class="col-sm-4 mb-2">--}}
{{--                                                                <input disabled class="form-control  mb-3"--}}
{{--                                                                       value="{{ @$order->tax }}">--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}





{{--                                                        --}}{{-- deliverable ------------------------------------------------------------------------------------- --}}
{{--                                                        <div class="col-12 ">--}}
{{--                                                            <label class="col-md-3 col-form-label" for="deliverable">متاح--}}
{{--                                                                للتوصيل</label>--}}
{{--                                                            @if(@$order->deliverable == 1 )--}}
{{--                                                                <p class="badge  bg-success h3" style="font-size:20px">--}}
{{--                                                                    نعم</p>--}}
{{--                                                            @else--}}
{{--                                                                <p class="badge  bg-danger h3" style="font-size:20px">--}}
{{--                                                                    لا</p>--}}
{{--                                                            @endif--}}
{{--                                                        </div>--}}






                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>


                                {{-- Butoooons ------------------------------------------------------------------------- --}}
                                <div class="row mb-3 text-end">
                                    <div>
                                        <a href="{{ route('admin.orders.index') }}"
                                           class="btn btn-outline-danger waves-effect waves-light ml-3 btn-sm">
                                            رجوع </a>

                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div> <!-- end row-->

    </div> <!-- container-fluid -->

@endsection


@section('style')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.5.6/full/ckeditor.js"></script>
@endsection
