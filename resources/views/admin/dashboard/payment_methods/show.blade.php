@extends('admin.layout')

@section('title', "وسيلة دفع " . @$payment_method->title)
@section('title_page',   "وسيلة دفع " . @$payment_method->title )

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="row">
                <div class="col-12 m-3">
                    <div class="row mb-3 text-end">
                        <div>
                            <a href="{{ route('admin.payment_methods.index') }}"
                               class="btn btn-outline-primary waves-effect waves-light ml-3 btn-sm">رجوع</a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.payment_methods.update', $payment_method->id) }}"
                                  method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-md-8">


                                        <div class="accordion mt-4 mb-4" id="accordionExample">
                                            <div class="accordion-item border rounded">
                                                <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button fw-medium" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                            aria-expanded="true" aria-controls="collapseOne">
                                                        بيانات وسيلة الدفع
                                                    </button>
                                                </h2>
                                                <div id="collapseOne" class="accordion-collapse collapse show mt-3"
                                                     aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">


{{--                                                        title ---------------------------------------------------------------------------------------}}
                                                        <div class="row mb-3">
                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label"> الاسم </label>
                                                            <div class="col-sm-10">
                                                                <input disabled class="form-control" type="text" name="title"
                                                                       value="{{ @$payment_method->title }}" id="title">
                                                            </div>
                                                            @if ($errors->has( 'title'))
                                                                <span
                                                                    class="missiong-spam">{{ $errors->first( 'title') }}</span>
                                                            @endif
                                                        </div>


{{--                                                        description ---------------------------------------------------------------------------------------}}
                                                        <div class="row mb-3">
                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label"> الوصف </label>
                                                            <div class="col-sm-10 mb-2">
                                                                    <textarea id="description" class="form-control" disabled
                                                                              name="content"> {{ @$payment_method->content }} </textarea>
                                                                @if($errors->has( 'content'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first(  'content') }}</span>
                                                                @endif
                                                            </div>


                                                        </div>


                                                    </div>
                                                </div>




                                            </div>




                                        </div>


                                        <div class="accordion mt-4 mb-4" id="accordionExampleThree">
                                            <div class="accordion-item border rounded">
                                                <h2 class="accordion-header" id="headingThree">
                                                    <button class="accordion-button fw-medium" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                            aria-expanded="true" aria-controls="collapseThree">
                                                        حسابات البنوك

                                                    </button>
                                                </h2>




                                                <!----------start third section ----->
                                                <div id="collapseThree" class="accordion-collapse collapse show mt-3" aria-labelledby="headingThree"
                                                     data-bs-parent="#accordionExampleThree">
                                                    <div class="accordion-body">


                                                        <!-------------------old banks ------------->
                                                        <div class="row" >
                                                            @foreach ($payment_method->banks as $banKey => $bankVal)  {{-- Loop through existing items --}}
                                                            <br>

                                                            <div class="row py-3"  >  {{-- Important: Add wire:key --}}
                                                                <div class="col-3 py-1">
                                                                    <input disabled class="form-control"   value="{{$bankVal->name_ar}}">
                                                                </div>
                                                                <div class="col-3 py-1">
                                                                    <input disabled  class="form-control"   value="{{$bankVal->name_en}}"  >
                                                                </div>
                                                                <div class="col-3 py-1">
                                                                    <input disabled  class="form-control"
                                                                           value="{{$bankVal->account_name}}"  >
                                                                </div>
                                                                <div class="col-3 py-1">
                                                                    <input disabled  class="form-control"   value="{{$bankVal->account_no}}"  >
                                                                </div>
                                                                <div class="col-3 py-1">
                                                                    <input disabled  class="form-control"   value="{{$bankVal->iban}}"  >
                                                                </div>
                                                                <div class="col-2 py-1">
                                                                    <img src="{{\Storage::url($bankVal->image)}}" width="100" height="100">
                                                                </div>

                                                            </div>
                                                            <br>

                                                            @endforeach  {{-- End of the loop --}}

                                                        </div>



                                                    </div>
                                                </div>
                                                <!------end third section ---->

                                            </div>




                                        </div>

                                    </div>


                                    <div class="col-md-4">

                                        <div class="accordion mt-4 mb-4" id="accordionExampleTwo">
                                            <div class="accordion-item border rounded">
                                                <h2 class="accordion-header" id="headingTwo">
                                                    <button class="accordion-button fw-medium" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                            aria-expanded="true" aria-controls="collapseTwo">
                                                        اعدادات وسيلة الدفع
                                                    </button>
                                                </h2>
                                                <div id="collapseTwo" class="accordion-collapse collapse show"
                                                     aria-labelledby="headingTwo" data-bs-parent="#accordionExampleTwo">
                                                    <div class="accordion-body">
                                                        <div class="col-12 mb-3">


                                                        </div>
{{--                                                        image ---------------------------------------------------------------------------------------}}
                                                        <div class="col-12">
                                                            <div class="row mb-3">
                                                                <img width="100" height="100" src="{{\App\Helpers\getImage($payment_method->image)}}">
                                                                <label for="example-number-input" col-form-label>
                                                                    الصورة :</label>
                                                                <div class="col-sm-12">


                                                                </div>
                                                            </div>
                                                        </div>


{{--                                                        minimum_price ---------------------------------------------------------------------------------------}}
                                                        <div class="col-12">
                                                            <label class="col-sm-12 col-form-label" for="minimum_price">ادني سعر</label>
                                                            <div class="col-sm-12">
                                                                <input disabled class="form-control" name="minimum_price"
                                                                       value="{{$payment_method->minimum_price}}"
                                                                       step="any" type="number" id="minimum_price">
                                                            </div>
                                                        </div>


{{--                                                        available_in_cart ---------------------------------------------------------------------------------------}}
                                                        <div class="col-12">
                                                            <label class="col-sm-12 col-form-label"
                                                                   for="available_in_cart">متاح بالسلة </label>
                                                            <div class="col-sm-10">
                                                                <input disabled class="form-check form-switch"
                                                                       {{$payment_method->available_in_cart == 1 ? 'checked' : ''}} name="available_in_cart"
                                                                       type="checkbox" id="available_in_cart"
                                                                       switch="success"   value="1">
                                                                <label class="form-label" for="available_in_cart"
                                                                       data-on-label=" نعم "
                                                                       data-off-label=" لا"></label>
                                                            </div>
                                                        </div>

{{--                                                        Status ---------------------------------------------------------------------------------------}}
                                                        <div class="col-12">
                                                            <label class="col-sm-12 col-form-label" for="available">
                                                                الحالة </label>
                                                            <div class="col-sm-10">
                                                                <input disabled class="form-check form-switch" name="status"
                                                                       type="checkbox" id="switch3" switch="success"
                                                                       {{ @$payment_method->status == 1 ? 'checked' : '' }} value="1">
                                                                <label class="form-label" for="switch3"
                                                                       data-on-label=" نعم "
                                                                       data-off-label="لا"></label>
                                                            </div>
                                                        </div>



                                                    </div>
                                                </div>




                                            </div>
                                        </div>


                                    </div>


                                </div>



{{--                                Butoooons ---------------------------------------------------------------------------}}
                                <div class="row mb-3 text-end">
                                    <div>
                                        <a href="{{ route('admin.payment_methods.index') }}"
                                           class="btn btn-outline-danger waves-effect waves-light ml-3 btn-sm">
                                            رجوع </a>

                                        


                                    </div>
                                </div>

                            </form>



                        </div>

                    </div>
                </div>
            </div> <!-- end col -->
        </div>



    </div> <!-- container-fluid -->

@endsection


@section('style')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.5.6/full/ckeditor.js"></script>
@endsection
