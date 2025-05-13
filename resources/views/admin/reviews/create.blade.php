@extends('admin.layout')

@section('title', "اضافة ريفيو")
@section('title_page',"اضافة ريفيو")

@section('content')

<div class="container-fluid">

    <div class="row">
        <div class="row">
            <div class="col-12 m-3">
                <div class="row mb-3 text-end">
                    <div>
                        <a href="{{ route('admin.reviews.index') }}" class="btn btn-outline-primary waves-effect waves-light ml-3 btn-sm">رجوع</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">

                        <form action="{{ route('admin.reviews.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-8">
                                    {{-- @foreach ($languages as $key => $locale)--}}
                                    <div class="accordion mt-4 mb-4" id="accordionExample">
                                        <div class="accordion-item border rounded">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    {{-- {{ trans('lang.' . Locale::getDisplayName($locale)) }}--}}
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show mt-3" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">

                                                    <div class="row mb-3 title-section">
                                                        <label for="example-text-input" class="col-sm-2 col-form-label">الاسم</label>

                                                        <div class="col-sm-10">
                                                            <input type="text" id="title" name="name_ar" value="{{ old('name_ar') }}" class="form-control title" required>
                                                            @if ($errors->has('name_ar'))
                                                            <span class="missiong-spam">{{ $errors->first('name_ar') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3 slug-section">
                                                        <label for="example-text-input" class="col-sm-2 col-form-label">Slug
                                                        </label>
                                                        <div class="col-sm-10">
                                                            <input type="text" id="slug" name="slug" value="{{ old('slug') }}" class="form-control slug" required>
                                                            @if ($errors->has('slug'))
                                                            <span class="missiong-spam">{{ $errors->first('slug') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    @include('admin.layouts.scriptSlug')


                                                    {{-- Start Slug --}}
                                                    {{-- description ------------------------------------------------------------------------------------- --}}
                                                    <div class="row mb-3">
                                                        <label for="example-text-input" class="col-sm-2 col-form-label">الوصف
                                                        </label>
                                                        <div class="col-sm-10 mb-2">
                                                            <textarea class="form-control" id="description" name="description_ar"> {{old('description_ar')}} </textarea>
                                                            @if ($errors->has('description_ar'))
                                                            <span class="missiong-spam">{{ $errors->first('description_ar') }}</span>
                                                            @endif
                                                        </div>

                                                        <script type="text/javascript">
                                                            CKEDITOR.replace('description', {
                                                                filebrowserUploadUrl: "{{ route('admin.ckeditor.upload', ['_token' => csrf_token()]) }}"
                                                                , filebrowserUploadMethod: 'form'
                                                            });
                                                        </script>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    {{-- @endforeach--}}
                                    <div class="accordion mt-4 mb-4" id="accordionExample">
                                        <div class="accordion-item border rounded">
                                            <h2 class="accordion-header" id="headingTwo">
                                                <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                    بيانات الميتا
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse show mt-3" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">


                                                    {{-- meta_title_ ------------------------------------------------------------------------------------- --}}
                                                    <div class="row mb-3">
                                                        <label for="example-text-input" class="col-sm-2 col-form-label">عنوان ميتا</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" type="text" name="meta_title" value="{{ old( 'meta_title') }}" id="title">
                                                        </div>
                                                        @if ($errors->has('meta_title'))
                                                        <span class="missiong-spam">{{ $errors->first('meta_title') }}</span>
                                                        @endif
                                                    </div>

                                                    {{-- meta_description_ ------------------------------------------------------------------------------------- --}}
                                                    <div class="row mb-3">
                                                        <label for="example-text-input" class="col-sm-2 col-form-label">
                                                            وصف ميتا
                                                        </label>
                                                        <div class="col-sm-10 mb-2">
                                                            <textarea name="meta_description" class="form-control description"> {{old('meta_description')}} </textarea>
                                                            @if ($errors->has('meta_description'))
                                                            <span class="missiong-spam">{{ $errors->first('meta_description') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    {{-- meta_key_ ------------------------------------------------------------------------------------- --}}
                                                    <div class="row mb-3">
                                                        <label for="example-text-input" class="col-sm-2 col-form-label">
                                                            مفتاح ميتا
                                                        </label>
                                                        <div class="col-sm-10 mb-2">
                                                            <textarea name="meta_key" class="form-control description"> {{old('meta_key')}} </textarea>
                                                            @if ($errors->has('meta_key'))
                                                            <span class="missiong-spam">{{ $errors->first('meta_key') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <hr>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">

                                    <div class="accordion mt-4 mb-4" id="accordionExample">
                                        <div class="accordion-item border rounded">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    الاعدادات
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">

                                                    {{-- img ------------------------------------------------------------------------------------- --}}
                                                    <div class="col-12">
                                                        <div class="row mb-3">
                                                            <label for="example-number-input" col-form-label>
                                                                الصورة :</label>
                                                            <div class="col-sm-12">
                                                                {{-- <input class="form-control" type="file"--}}
                                                                {{-- placeholder="اختر صورة :"--}}
                                                                {{-- id="example-number-input" name="img"--}}
                                                                {{-- value="{{ old('img') }}">--}}


                                                                <!-------------test ------------>


                                                                @livewire('admin.review.upload-photos' , ['review_id' => null , 'review' => null] )

                                                                <!----------end test ------------>


                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- sort ------------------------------------------------------------------------------------- --}}
                                                    <div class="col-12">
                                                        <div class="row mb-3">
                                                            <label for="example-number-input" col-form-label>
                                                                الترتيب :</label>
                                                            <div class="col-sm-12">
                                                                <input class="form-control" type="number" placeholder="ادخل الترتيب :" id="example-number-input" name="sort" value="{{ old('sort') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- feature ------------------------------------------------------------------------------------- --}}
                                                    <div class="col-12">
                                                        <label class="col-sm-12 col-form-label" for="available">ميزة </label>
                                                        <div class="col-sm-10">
                                                            <input class="form-check form-switch" name="feature" type="checkbox" id="switch1" switch="success" checked value="1">
                                                            <label class="form-label" for="switch1" data-on-label=" نعم " data-off-label=" لا"></label>
                                                        </div>
                                                    </div>

                                                    {{-- Status ------------------------------------------------------------------------------------- --}}
                                                    <div class="col-12">
                                                        <label class="col-sm-12 col-form-label" for="available">الحالة</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-check form-switch" name="status" type="checkbox" id="switch3" switch="success" checked value="1">
                                                            <label class="form-label" for="switch3" data-on-label=" نعم " data-off-label="لا"></label>
                                                        </div>
                                                    </div>


                                                    {{-- deliverable ------------------------------------------------------------------------------------- --}}
                                                    <div class="col-12">
                                                        <label class="col-sm-12 col-form-label" for="switch4">deliverable</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-check form-switch" name="deliverable" type="checkbox" id="switch4" switch="success" checked value="1">
                                                            <label class="form-label" for="switch4" data-on-label=" نعم " data-off-label="لا"></label>
                                                        </div>
                                                    </div>
                                                    {{-- taxable ------------------------------------------------------------------------------------- --}}
                                                    <div class="col-12">
                                                        <label class="col-sm-12 col-form-label" for="taxable">شامل الضريبة</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-check form-switch" name="taxable" type="checkbox" id="taxable" switch="success" checked value="1">
                                                            <label class="form-label" for="taxable" data-on-label=" نعم " data-off-label="لا"></label>
                                                        </div>
                                                    </div>
                                                    {{-- no_carton ------------------------------------------------------------------------------------- --}}
                                                    <div class="col-12">
                                                        <label class="col-sm-12 col-form-label" for="no_carton">no_carton</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-check form-switch" name="no_carton" type="checkbox" id="no_carton" switch="success" checked value="1">
                                                            <label class="form-label" for="no_carton" data-on-label=" نعم " data-off-label="لا"></label>
                                                        </div>
                                                    </div>





                                                    <!---category_id------>
                                                    <div class="col-12">
                                                        <div class="row mb-3">
                                                            <label for="example-number-input" col-form-label>
                                                                القسم :</label>
                                                            <div class="col-sm-12">
                                                                <select name="category_id" class="form-control">
                                                                    <option value="">اختر القسم</option>
                                                                    @isset($categories)
                                                                    @forelse(@$categories as $category)

                                                                    <option {{   old('category_id') ?     'selected' : ''}} value="{{$category->id}}"> {{ $category->name_ar  }} </option>

                                                                    @empty

                                                                    @endforelse
                                                                    @endisset


                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <!---$mosques------>
                                                    <div class="col-12">
                                                        <div class="row mb-3">
                                                            <label for="example-number-input" col-form-label>
                                                                mosques :</label>
                                                            <div class="col-sm-12">
                                                                <select name="mosque_id[]" multiple class="form-select form-select-sm select2">
                                                                    <option value="">اختر mosque</option>
                                                                    @isset($mosques)
                                                                    @forelse(@$mosques as $mosque)

                                                                    <option {{   old('mosque_id') ?     'selected' : ''}} value="{{$mosque->id}}"> {{ $mosque->name_ar  }} </option>

                                                                    @empty

                                                                    @endforelse
                                                                    @endisset


                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>




                                                    <div class="col-12">
                                                        <label class="col-sm-12 col-form-label" for="available">السعر</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" name="price" type="number" value="{{old('price')}}" step="any" min="0">

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
                                    <a href="{{ route('admin.reviews.index') }}" class="btn btn-outline-primary waves-effect waves-light ml-3 btn-sm">رجوع</a>
                                    <button type="submit" class="btn btn-outline-success waves-effect waves-light ml-3 btn-sm">حفظ</button>
                                </div>
                            </div>


                        </form>

                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div> <!-- end row-->

</div> <!-- container-fluid -->

@endsection


@section('style')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
{{-- <script src="https://cdn.ckeditor.com/4.5.6/full/ckeditor.js"></script> --}}
<script src="{{ asset('client/js/ckeditor/ckeditor.js') }}"></script>
@endsection
