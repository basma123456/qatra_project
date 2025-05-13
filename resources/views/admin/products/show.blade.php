@extends('admin.layout')

@section('title', "منتج " . @$product->name_ar)
@section('title_page',   "منتج " . @$product->name_ar )

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="row">
                <div class="col-12 m-3">
                    <div class="row mb-3 text-end">
                        <div>
                            <a href="{{ route('admin.products.index') }}"
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
                                                        <div class="row mb-3">
                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label"> الاسم </label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control" type="text" name="name_ar"
                                                                       disabled value="{{ @$product->name_ar }}"
                                                                       id="name_ar">
                                                            </div>
                                                            @if ($errors->has( 'name_ar'))
                                                                <span
                                                                    class="missiong-spam">{{ $errors->first( 'name_ar') }}</span>
                                                            @endif
                                                        </div>

                                                        {{-- slug ------------------------------------------------------------------------------------- --}}
                                                        {{-- Start Slug --}}
                                                        <div class="row mb-3 slug-section">
                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label"> Slug </label>

                                                            <div class="col-sm-10">
                                                                <input type="text" id="slug" name="slug"
                                                                       disabled value="{{ @$product->slug }}"
                                                                       class="form-control slug mb-3" required>
                                                                @if ($errors->has( 'slug'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first( 'slug') }}</span>
                                                                @endif
                                                            </div>

                                                            {{-- End Slug --}}
                                                            {{-- description ------------------------------------------------------------------------------------- --}}
                                                            <div class="row mb-3">
                                                                <label for="example-text-input"
                                                                       class="col-sm-2 col-form-label"> الوصف </label>
                                                                <div class="col-sm-10 mb-2">
                                                                    <textarea id="description" disabled
                                                                              name="description"> {{ @$product->description }} </textarea>
                                                                    @if($errors->has(  'description'))
                                                                        <span
                                                                            class="missiong-spam">{{ $errors->first(  'description') }}</span>
                                                                    @endif
                                                                </div>

                                                                <script type="text/javascript">
                                                                    $(function () {
                                                                        CKEDITOR.replace('description');
                                                                        $('textarea').wysihtml5()
                                                                    })

                                                                </script>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            {{--                                        /////////--}}

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
                                                            <div class="row mb-3">
                                                                <label for="example-text-input"
                                                                       class="col-sm-2 col-form-label"> عنوان
                                                                    ميتا </label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control" type="text"
                                                                           name="meta_title"
                                                                           disabled value="{{ @$product->meta_title }}"
                                                                           id="name_ar">
                                                                </div>
                                                                @if ($errors->has( 'meta_title'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first( 'meta_title') }}</span>
                                                                @endif
                                                            </div>

                                                            {{-- meta_description_ ------------------------------------------------------------------------------------- --}}
                                                            <div class="row mb-3">
                                                                <label for="example-text-input"
                                                                       class="col-sm-2 col-form-label"> وصف ميتا
                                                                </label>
                                                                <div class="col-sm-10 mb-2">
                                                                    <textarea name="meta_description"
                                                                              disabled
                                                                              class="form-control description"> {{ @$product->meta_description }} </textarea>
                                                                    @if ($errors->has( 'meta_description'))
                                                                        <span
                                                                            class="missiong-spam">{{ $errors->first( 'meta_description') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            {{-- meta_key_ ------------------------------------------------------------------------------------- --}}
                                                            <div class="row mb-3">
                                                                <label for="example-text-input"
                                                                       class="col-sm-2 col-form-label"> مفتاح ميتا
                                                                </label>
                                                                <div class="col-sm-10 mb-2">
                                                                    <textarea name="meta_key"
                                                                              disabled
                                                                              class="form-control description"> {{ @$product->meta_key }} </textarea>
                                                                    @if ($errors->has( 'meta_key'))
                                                                        <span
                                                                            class="missiong-spam">{{ $errors->first( 'meta_key') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <hr>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                                                        {{--                                                        <div class="col-sm-3 mb-3">--}}

                                                        {{--                                                            <img src="{{ asset($product->getFirstPhoto()) }}" alt=""--}}
                                                        {{--                                                                 style="width:100%">--}}

                                                        {{--                                                        </div>--}}
                                                        <div class="container d-flex">
                                                            @if($product->img && is_array(json_decode($product->img , true)))
                                                                @foreach(json_decode($product->img , true) as $key => $image)
                                                                    @if($image)
                                                                        <img class="col"
                                                                             style="width: 100px; height: 100px; border-radius: 20px; border: 2px solid white"
                                                                             src="{{asset('storage/'.$image)}}">
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </div>

                                                        {{-- sort ------------------------------------------------------------------------------------- --}}
                                                        <div class="col-12">
                                                            <div class="row mb-3">
                                                                <label for="example-number-input" col-form-label>
                                                                    الترتيب :</label>
                                                                <div class="col-sm-12">
                                                                    <input class="form-control" type="number"
                                                                           disabled placeholder="ادخل الترتيب :"
                                                                           id="example-number-input" name="sort"
                                                                           value="{{ @$product->sort }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- feature ------------------------------------------------------------------------------------- --}}

                                                        <div class="col-12 ">
                                                            <label class="col-md-3 col-form-label" for="feature">
                                                                ميزة </label>
                                                            @if(@$product->feature == 1 )
                                                                <p class="badge  bg-success h3" style="font-size:20px">
                                                                    نعم </p>
                                                            @else
                                                                <p class="badge  bg-danger h3" style="font-size:20px">
                                                                    لا </p>
                                                            @endif
                                                        </div>


                                                        {{-- Status ------------------------------------------------------------------------------------- --}}
                                                        <div class="col-12 ">
                                                            <label class="col-md-3 col-form-label" for="status">
                                                                الحالة </label>
                                                            @if(@$product->status == 1 )
                                                                <p class="badge  bg-success h3" style="font-size:20px">
                                                                    نعم</p>
                                                            @else
                                                                <p class="badge  bg-danger h3" style="font-size:20px">
                                                                    لا</p>
                                                            @endif
                                                        </div>


                                                        {{-- deliverable ------------------------------------------------------------------------------------- --}}
                                                        <div class="col-12 ">
                                                            <label class="col-md-3 col-form-label" for="deliverable">متاح
                                                                للتوصيل</label>
                                                            @if(@$product->deliverable == 1 )
                                                                <p class="badge  bg-success h3" style="font-size:20px">
                                                                    نعم</p>
                                                            @else
                                                                <p class="badge  bg-danger h3" style="font-size:20px">
                                                                    لا</p>
                                                            @endif
                                                        </div>


                                                        <div class="col-12 ">
                                                            <label class="col-md-3 col-form-label" for="taxable">
                                                                شامل الضريبة
                                                            </label>
                                                            @if(@$product->taxable == 1 )
                                                                <p class="badge  bg-success h3" style="font-size:20px">
                                                                    نعم</p>
                                                            @else
                                                                <p class="badge  bg-danger h3" style="font-size:20px">
                                                                    لا</p>
                                                            @endif
                                                        </div>


                                                        <div class="col-12 ">
                                                            <label class="col-md-3 col-form-label" for="no_carton">غير
                                                                معلب</label>
                                                            @if(@$product->no_carton == 1 )
                                                                <p class="badge  bg-success h3" style="font-size:20px">
                                                                    نعم</p>
                                                            @else
                                                                <p class="badge  bg-danger h3" style="font-size:20px">
                                                                    لا</p>
                                                            @endif
                                                        </div>


                                                        <!---category_id------>
                                                        <div class="col-12">
                                                            <div class="row mb-3">
                                                                <label for="example-number-input" col-form-label>
                                                                    القسم :</label>
                                                                <div class="col-sm-12">
                                                                    <select name="category_id" disabled
                                                                            class="form-control">
                                                                        <option value="">اختر القسم</option>
                                                                        @forelse($categories as $category)
                                                                            <option
                                                                                {{( $product->category_id ==  old('category_id') || $product->category_id == $category->id)   ? 'selected' : ''}}   value="{{$category->id}}"> {{  $category->name_ar  }} </option>
                                                                        @empty

                                                                        @endforelse
                                                                    </select>


                                                                </div>
                                                            </div>
                                                        </div>


                                                        {{-- price ------------------------------------------------------------------------------------- --}}
                                                        <div class="col-12">
                                                            <div class="row mb-3">
                                                                <label for="example-number-input" col-form-label>
                                                                    السعر :</label>
                                                                <div class="col-sm-12">
                                                                    <input class="form-control" type="number" disabled
                                                                           placeholder="  السعر :"
                                                                           id="example-number-input" name="price"
                                                                           step="any" value="{{ @$product->price }}">
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>


                                </div>


                                {{-- Butoooons ------------------------------------------------------------------------- --}}
                                <div class="row mb-3 text-end">
                                    <div>
                                        <a href="{{ route('admin.products.index') }}"
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
