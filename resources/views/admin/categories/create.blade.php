@extends('admin.layout')

@section('title', "اضافة صنف")
@section('title_page',"اضافة صنف")

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="row">
                <div class="col-12 m-3">
                    <div class="row mb-3 text-end">
                        <div>
                            <a href="{{ route('admin.categories.index') }}"
                               class="btn btn-outline-primary waves-effect waves-light ml-3 btn-sm">الغاء</a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">

                            <form action="{{ route('admin.categories.store') }}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8">
                                        {{--                                        @foreach ($languages as $key => $locale)--}}
                                        <div class="accordion mt-4 mb-4" id="accordionExample">
                                            <div class="accordion-item border rounded">
                                                <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button fw-medium" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapseOne"
                                                            aria-expanded="true"
                                                            aria-controls="collapseOne">
                                                        {{--                                                            {{ trans('lang.' . Locale::getDisplayName($locale)) }}--}}
                                                    </button>
                                                </h2>
                                                <div id="collapseOne"
                                                     class="accordion-collapse collapse show mt-3"
                                                     aria-labelledby="headingOne"
                                                     data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">

                                                        <div class="row mb-3 title-section">
                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label">الاسم</label>

                                                            <div class="col-sm-10">
                                                                <input type="text" id="title"
                                                                       name="name_ar"
                                                                       value="{{ old('name_ar') }}"
                                                                       class="form-control title" required>
                                                                @if ($errors->has('name_ar'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first('name_ar') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3 slug-section">
                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label">Slug
                                                            </label>

                                                            <div class="col-sm-10">
                                                                <input type="text" id="slug"
                                                                       name="slug"
                                                                       value="{{ old('slug') }}"
                                                                       class="form-control slug" required>
                                                                @if ($errors->has('slug'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first('slug') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @include('admin.layouts.scriptSlug')


                                                        {{-- Start Slug --}}
                                                        {{-- description ------------------------------------------------------------------------------------- --}}
                                                        <div class="row mb-3">
                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label">الوصف
                                                            </label>
                                                            <div class="col-sm-10 mb-2">
                                                                    <textarea class="form-control" id="description"
                                                                              name="description"> {{old('description')}} </textarea>
                                                                @if ($errors->has('description'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first('description') }}</span>
                                                                @endif
                                                            </div>

                                                            <script type="text/javascript">
                                                                $(function () {
                                                                    CKEDITOR.replace('description');
                                                                    $('.textarea').wysihtml5()
                                                                })
                                                            </script>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        {{--                                        @endforeach--}}
                                        <div class="accordion mt-4 mb-4" id="accordionExample">
                                            <div class="accordion-item border rounded">
                                                <h2 class="accordion-header" id="headingTwo">
                                                    <button class="accordion-button fw-medium" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapseTwo"
                                                            aria-expanded="true"
                                                            aria-controls="collapseTwo">
                                                     بيانات الميتا
                                                    </button>
                                                </h2>
                                                <div id="collapseTwo"
                                                     class="accordion-collapse collapse show mt-3"
                                                     aria-labelledby="headingTwo"
                                                     data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">


                                                        {{-- meta_title_ ------------------------------------------------------------------------------------- --}}
                                                        <div class="row mb-3">
                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label">عنوان ميتا</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control" type="text"
                                                                       name="meta_title"
                                                                       value="{{ old( 'meta_title') }}"
                                                                       id="title">
                                                            </div>
                                                            @if ($errors->has('meta_title'))
                                                                <span
                                                                    class="missiong-spam">{{ $errors->first('meta_title') }}</span>
                                                            @endif
                                                        </div>

                                                        {{-- meta_description_ ------------------------------------------------------------------------------------- --}}
                                                        <div class="row mb-3">
                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label">
                                                               وصف ميتا
                                                            </label>
                                                            <div class="col-sm-10 mb-2">
                                                                    <textarea name="meta_description"
                                                                              class="form-control description">  {{old('meta_description')}}   </textarea>
                                                                @if ($errors->has('meta_description'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first('meta_description') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        {{-- meta_key_ ------------------------------------------------------------------------------------- --}}
                                                        <div class="row mb-3">
                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label">
                                                               مفتاح ميتا
                                                            </label>
                                                            <div class="col-sm-10 mb-2">
                                                                    <textarea name="meta_key"
                                                                              class="form-control description">    {{old('meta_key')}}  </textarea>
                                                                @if ($errors->has('meta_key'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first('meta_key') }}</span>
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
                                                    <button class="accordion-button fw-medium" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                            aria-expanded="true" aria-controls="collapseOne">
                                                       الاعدادات
                                                    </button>
                                                </h2>
                                                <div id="collapseOne" class="accordion-collapse collapse show"
                                                     aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">

                                                        {{--                                                         img ------------------------------------------------------------------------------------- --}}

                                                        {{--                                                         sort ------------------------------------------------------------------------------------- --}}
                                                        <div class="col-12">
                                                            <div class="row mb-3">
                                                                <label for="example-number-input" col-form-label>
                                                                   الترتيب :</label>
                                                                <div class="col-sm-12">
                                                                    <input class="form-control" type="number"
                                                                           placeholder="ادخل الترتيب :"
                                                                           id="example-number-input" name="sort"
                                                                           value="{{ old('sort') }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- feature ------------------------------------------------------------------------------------- --}}
                                                        <div class="col-12">
                                                            <label class="col-sm-12 col-form-label"
                                                                   for="available">ميزة </label>
                                                            <div class="col-sm-10">
                                                                <input class="form-check form-switch" name="feature"
                                                                       type="checkbox" id="switch1" switch="success"
                                                                       checked value="1">
                                                                <label class="form-label" for="switch1"
                                                                       data-on-label=" نعم "
                                                                       data-off-label=" لا"></label>
                                                            </div>
                                                        </div>

                                                        {{-- Status ------------------------------------------------------------------------------------- --}}
                                                        <div class="col-12">
                                                            <label class="col-sm-12 col-form-label"
                                                                   for="available">الحالة</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-check form-switch" name="status"
                                                                       type="checkbox" id="switch3" switch="success"
                                                                       checked value="1">
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

                                {{-- Butoooons ------------------------------------------------------------------------- --}}
                                <div class="row mb-3 text-end">
                                    <div>
                                        <a href="{{ route('admin.categories.index') }}"
                                           class="btn btn-outline-primary waves-effect waves-light ml-3 btn-sm">الغاء</a>
                                        <button type="submit"
                                                class="btn btn-outline-success waves-effect waves-light ml-3 btn-sm">حفظ</button>
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
    <script src="https://cdn.ckeditor.com/4.5.6/full/ckeditor.js"></script>
@endsection
