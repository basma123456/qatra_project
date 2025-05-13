@extends('admin.layout')

@section('title', " اضافة مدير رئيسي  ")
@section('title_page',"  اضافة مدير رئيسي ")

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="row">
                <div class="col-12 m-3">
                    <div class="row mb-3 text-end">
                        <div>
                            <a href="{{ route('admin.super_admins.index') }}"
                               class="btn btn-outline-primary waves-effect waves-light ml-3 btn-sm">رجوع</a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">

                            <form action="{{ route('admin.super_admins.store') }}" method="post"
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
                                                                       name="name"
                                                                       value="{{ old('name') }}"
                                                                       class="form-control title" required>
                                                                @if ($errors->has('name'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first('name') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3 slug-section">
                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label">الجوال
                                                            </label>

                                                            <div class="col-sm-10">
                                                                <input type="text" id="mobile"
                                                                       name="mobile"
                                                                       value="{{ old('mobile') }}"
                                                                       class="form-control slug" required>
                                                                @if ($errors->has('mobile'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first('mobile') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>



                                                        {{-- Start Slug --}}
                                                        {{-- description ------------------------------------------------------------------------------------- --}}
                                                        <div class="row mb-3">
                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label">البريد الالكتروني
                                                            </label>
                                                            <div class="col-sm-10 mb-2">
                                                                    <input class="form-control" id="email" type="email" value="{{old('email')}}"
                                                                              name="email">
                                                                @if ($errors->has('email'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first('email') }}</span>
                                                                @endif
                                                            </div>

                                                        </div>

                                                        {{-- password ------------------------------------------------------------------------------------- --}}
                                                        <div class="row mb-3">
                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label">كلمة المرور
                                                            </label>
                                                            <div class="col-sm-10 mb-2">
                                                                <input class="form-control" id="password" type="password" value="{{old('password')}}"
                                                                       name="password">
                                                                @if ($errors->has('password'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first('password') }}</span>
                                                                @endif
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        {{--                                        @endforeach--}}

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
                                                        <div class="col-12">
                                                            <div class="row mb-3">
                                                                <label for="example-number-input" col-form-label>
                                                                    الصورة :</label>
                                                                <div class="col-sm-12">
                                                                    <input class="form-control" type="file"
                                                                           placeholder="اختر صورة :"
                                                                           id="example-number-input" name="image"
                                                                           value="{{ old('image') }}">
                                                                </div>
                                                            </div>
                                                        </div>



                                                        {{-- Status ------------------------------------------------------------------------------------- --}}
{{--                                                        <div class="col-12">--}}
{{--                                                            <label class="col-sm-12 col-form-label"--}}
{{--                                                                   for="available">الحالة</label>--}}
{{--                                                            <div class="col-sm-10">--}}
{{--                                                                <input class="form-check form-switch" name="status"--}}
{{--                                                                       type="checkbox" id="switch3" switch="success"--}}
{{--                                                                       checked value="1">--}}
{{--                                                                <label class="form-label" for="switch3"--}}
{{--                                                                       data-on-label=" نعم "--}}
{{--                                                                       data-off-label="لا"></label>--}}
{{--                                                            </div>--}}
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
                                        <a href="{{ route('admin.super_admins.index') }}"
                                           class="btn btn-outline-primary waves-effect waves-light ml-3 btn-sm">رجوع</a>
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
    <<script src="https://cdn.ckeditor.com/4.5.6/full/ckeditor.js"></script>
@endsection
