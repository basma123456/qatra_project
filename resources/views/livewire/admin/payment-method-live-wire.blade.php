<div class="row">

    <form wire:submit.prevent="store">
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
                                        <input type="text" id="title" wire:model.defer="title"
                                               class="form-control title" required>
                                        @error('title') <span class="missiong-spam">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="description" class="col-sm-2 col-form-label">الوصف</label>
                                    <div class="col-sm-10 mb-2">
                                        <textarea class="form-control" id="description"
                                                  wire:model.defer="content"></textarea>
                                        @error('content') <span class="missiong-spam">{{ $message }}</span> @enderror
                                    </div>
                                </div>


                                <div class="row mb-3 title-section">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">كود الدفع</label>

                                    <div class="col-sm-10">
                                        <input type="text" id="payment_key" wire:model.defer="payment_key"
                                               value="{{ old('payment_key') }}" class="form-control title">
                                        @if ($errors->has('payment_key'))
                                            <span class="missiong-spam">{{ $errors->first('payment_key') }}</span>
                                        @endif
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>


                <!-----second accordion -->
                <div class="accordion mt-4 mb-4" id="accordionExampleThree">
                    <div class="accordion-item border rounded">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                {{-- {{ trans('lang.' . Locale::getDisplayName($locale)) }}--}}
                                حسابات البنوك
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse show mt-3" aria-labelledby="headingThree"
                             data-bs-parent="#accordionExampleThree">
                            <div class="accordion-body">

                                <!-------------start banks ---------------->

                                <div class="row" id="whole_row">
                                    @foreach ($name_ar as $key => $value)  {{-- Loop through existing items --}}
                                    <br>

                                    <div class="row py-3" wire:key="row-{{ $key }}">  {{-- Important: Add wire:key --}}
                                        <div class="col-3 py-2">
                                            <input required class="form-control" placeholder="الاسم ابلعربية" wire:model.defer="name_ar.{{ $key }}">
                                        </div>
                                        <div class="col-3 py-2">
                                            <input required  class="form-control" placeholder="الاسم بالانجليزية" wire:model.defer="name_en.{{ $key }}">
                                        </div>
                                        <div class="col-3 py-2">
                                            <input required  class="form-control" placeholder="اسم الحساب"
                                                   wire:model.defer="account_name.{{ $key }}">
                                        </div>
                                        <div class="col-3 py-2">
                                            <input required  class="form-control" placeholder="رقم الحساب" wire:model.defer="account_no.{{ $key }}">
                                        </div>
                                        <div class="col-3 py-2">
                                            <input required  class="form-control" placeholder="iban" wire:model.defer="iban.{{ $key }}">
                                        </div>
                                        <div class="col-2 py-2">
                                            <input required  type="file" class="form-control"  wire:model.defer="bank_image.{{ $key }}">
                                        </div>

                                        {{--                    <div class="col-1">--}}
                                        {{--                        <input class="form-control" placeholder="status" wire:model.defer="payment_method_id.{{ $key }}">--}}
                                        {{--                    </div>--}}
                                        <div class="col-1 py-2">
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


                                <!---end banks ------------------------------->

                            </div>
                        </div>
                    </div>
                </div>

                <!--end secnd accordion -->

            </div>
            <div class="col-md-4">
                <div class="accordion mt-4 mb-4" id="accordionExample">
                    <div class="accordion-item border rounded">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                {{-- {{ trans('lang.' . Locale::getDisplayName($locale)) }}--}}
                                اعدادات وسيلة الدفع
                            </button>
                        </h2>

                        <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo"
                             data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="col-12">
                                    <div class="row mb-3">
                                        <label for="image" class="col-form-label">الصورة :</label>
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
                                        <input class="form-control" wire:model.defer="minimum_price" type="number"
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
                                        <input class="form-check form-switch" wire:model.defer="available_in_cart"
                                               type="checkbox" id="available_in_cart" switch="success" checked
                                               value="1">
                                        <label class="form-label" for="available_in_cart" data-on-label=" نعم "
                                               data-off-label=" لا"></label>
                                    </div>
                                </div>
                                {{--                                Status ---------------------------------------------------------------------------------------}}
                                <div class="col-12">
                                    <label class="col-sm-12 col-form-label" for="available">الحالة</label>
                                    <div class="col-sm-10">
                                        <input class="form-check form-switch" wire:model.defer="status" type="checkbox"
                                               id="switch3" switch="success" checked value="1">
                                        <label class="form-label" for="switch3" data-on-label=" نعم "
                                               data-off-label="لا"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>

        <div class="row mb-3 text-end">
            <div>
                <button type="submit" class="btn btn-outline-success waves-effect waves-light ml-3 btn-sm">حفظ
                </button>
            </div>

            @if($success)
                <div class="row alert alert-success">
                    لقد ادخلت هذا الاجراء بنجاح
                </div>
            @endif
        </div>

    </form>


</div>
