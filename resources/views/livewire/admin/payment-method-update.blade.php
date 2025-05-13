<div class="row">
{{--    <form wire:submit.prevent="update">--}}
    <div >

    <div class="row">
            <div class="col-md-8">
                <div class="accordion mt-4 mb-4" id="accordionExample">
                    <div class="accordion-item border rounded">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    بيانات وسيلة الدفع
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show mt-3" aria-labelledby="headingOne"
                             data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="row mb-3 title-section">
                                    <label for="title" class="col-sm-2 col-form-label">الاسم</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="title" wire:model.defer="title" value="{{$payment_method->title}}"
                                               class="form-control title" required>
                                        @error('title') <span class="missiong-spam">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="description" class="col-sm-2 col-form-label">الوصف</label>
                                    <div class="col-sm-10 mb-2">
                                        <textarea class="form-control" id="description"
                                                  wire:model.defer="content">{{$payment_method->content}}</textarea>
                                        @error('content') <span class="missiong-spam">{{ $message }}</span> @enderror
                                    </div>
                                </div>


                                <div class="row mb-3 title-section">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">كود الدفع</label>

                                    <div class="col-sm-10">
                                        <input type="text" id="payment_key" wire:model.defer="payment_key"
                                               value="{{ $payment_method->payment_key ?? old('payment_key') }}" class="form-control title">
                                        @if ($errors->has('payment_key'))
                                            <span class="missiong-spam">{{ $errors->first('payment_key') }}</span>
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
                            <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
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

                                        {{--                    <div class="col-1">--}}
                                        {{--                        <input class="form-control" placeholder="status" wire:model.defer="payment_method_id.{{ $key }}">--}}
                                        {{--                    </div>--}}
                                        <div class="col-2 py-1">
                                            <button type="button" class="btn btn-danger" wire:click="deleteThis({{$bankVal->id}})">حذف
                                            </button> {{-- Remove button --}}
                                        </div>
                                    </div>
                                    <br>

                                    @endforeach  {{-- End of the loop --}}

                                </div>

                                <!--------------end old banks --------------->

                                <!-------------start banks ---------------->

                                <div class="row" id="whole_row">
                                    @foreach ($name_ar as $key => $value)  {{-- Loop through existing items --}}
                                    <br>

                                    <div class="row py-3" wire:key="row-{{ $key }}">  {{-- Important: Add wire:key --}}
                                        <div class="col-3 py-1">
                                            <input required class="form-control" placeholder="الاسم بالعربية" wire:model="name_ar.{{ $key }}">
                                            @error('name_ar.'.$key ) <span class="missiong-spam">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="col-3 py-1">
                                            <input required  class="form-control" placeholder="الاسم بالانجليزية" wire:model.defer="name_en.{{ $key }}">
                                            @error('name_en.'.$key ) <span class="missiong-spam">{{ $message }}</span> @enderror

                                        </div>
                                        <div class="col-3 py-1">
                                            <input required  class="form-control" placeholder="اسم الحساب"
                                                   wire:model.defer="account_name.{{ $key }}">
                                            @error('account_name.'.$key ) <span class="missiong-spam">{{ $message }}</span> @enderror

                                        </div>
                                        <div class="col-3 py-1">
                                            <input required  class="form-control" placeholder="رقم الحساب" wire:model.defer="account_no.{{ $key }}">
                                            @error('account_no.'.$key ) <span class="missiong-spam">{{ $message }}</span> @enderror

                                        </div>
                                        <div class="col-3 py-1">
                                            <input required  class="form-control" placeholder="iban" wire:model.defer="iban.{{ $key }}">
                                            @error('iban.'.$key ) <span class="missiong-spam">{{ $message }}</span> @enderror

                                        </div>
                                        <div class="col-2 py-1">
                                            <input required  type="file" class="form-control"  wire:model.defer="bank_image.{{ $key }}">
                                            @error('bank_image.'.$key ) <span class="missiong-spam">{{ $message }}</span> @enderror

                                        </div>

                                        {{--                    <div class="col-1">--}}
                                        {{--                        <input class="form-control" placeholder="status" wire:model.defer="payment_method_id.{{ $key }}">--}}
                                        {{--                    </div>--}}
                                        <div class="col-2 py-1">
                                            <button type="button" class="btn btn-danger" wire:click="removeRow({{ $key }})">-
                                            </button> {{-- Remove button --}}
                                        </div>
                                    </div>
                                    <br>

                                    @endforeach  {{-- End of the loop --}}
                                    <div class="row">  {{-- Add new row button outside the loop --}}
                                        <div class="col-1">
                                            <button type="button" class="btn btn-success" wire:click="addRow">+</button>
                                        </div>
                                    </div>

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
                            <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                    اعدادات وسيلة الدفع
                            </button>
                        </h2>

                        <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExampleTwo">


                            <div class="accordion-body">
                                <div class="col-12">
                                    <div class="row mb-3">
                                        <label for="image" class="col-form-label">الصورة :</label>
                                        <div class="row">
                                            <img src="{{\Storage::url($payment_method->image)}}" width="100" height="100">
                                        </div>
                                        <div class="col-sm-12">
                                            <input class="form-control" type="file" id="image" wire:model="image">
                                            @error('image') <span class="missiong-spam">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>


                                {{--                                minimum_price ---------------------------------------------------------------------------------------}}
                                <div class="col-12">
                                    <label class="col-sm-12 col-form-label" for="minimum_price">ادني سعر </label>
                                    <div class="col-sm-12">
                                        <input class="form-control" wire:model.defer="minimum_price" type="number"  value="{{$payment_method->minimum_price}}"
                                               step="any" id="minimum_price">
                                        <label class="form-label" for="available_in_cart" data-on-label=" نعم "
                                               data-off-label=" لا"></label>
                                    </div>
                                </div>

                                {{--                                available_in_cart ---------------------------------------------------------------------------------------}}
                                <div class="col-12">
                                    <label class="col-sm-12 col-form-label"
                                           for="available_in_cart">متاح بالسلة </label>
                                    <div class="col-sm-10">
                                        <input class="form-check form-switch" wire:model.defer="available_in_cart"  {{$payment_method->available_in_cart == 1 ? 'checked' : ''}}
                                               type="checkbox" id="available_in_cart" switch="success"
                                               value="1">
                                        <label class="form-label" for="available_in_cart" data-on-label=" نعم "
                                               data-off-label=" لا"></label>
                                    </div>
                                </div>
                                {{--                                Status ---------------------------------------------------------------------------------------}}
                                <div class="col-12">
                                    <label class="col-sm-12 col-form-label" for="available">الحالة</label>
                                    <div class="col-sm-10">
                                        <input class="form-check form-switch" wire:model.defer="status" type="checkbox"  {{$payment_method->status == 1 ? 'checked' : ''}}
                                               id="switch3" switch="success"  value="1">
                                        <label class="form-label" for="switch3" data-on-label=" نعم "
                                               data-off-label="لا"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>






            <!---end banks ------------------------------->
            <div class="row mb-3 text-end">
                <div>
                    <button type="submit" wire:click="update" class="btn btn-outline-success waves-effect waves-light ml-3 btn-sm">حفظ
                    </button>
                </div>

                @if($success)
                    <div class="row alert alert-success">
                        لقد ادخلت هذا الاجراء بنجاح
                    </div>
                @endif
            </div>

        </div>

    </div>


</div>
