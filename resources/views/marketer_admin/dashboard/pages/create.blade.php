@extends('admin.layout')

@section('title', "الصفحات")
@section('title_page', "انشئ صفحة")

@section('content')

<div class="container-fluid">

    <div class="row">
        <div class="row">
            <div class="col-12 m-3">
                <div class="row mb-3 text-end">
                    <div>
                        <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-primary waves-effect waves-light ml-3 btn-sm">رجوع</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">

                        <form action="{{ route('admin.pages.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-8">

                                    <div class="accordion mt-4 mb-4" id="accordionExample">
                                        <div class="accordion-item border rounded">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    البيانات
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show mt-3" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">



                                                    {{-- title ------------------------------------------------------------------------------------- --}}
                                                    <div class="row mb-3">
                                                        <label for="example-text-input" class="col-sm-2 col-form-label">العنوان</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" type="text" name="title" value="{{ old('title') }}" id="title">
                                                            @if ($errors->has('title'))
                                                            <span class="missiong-spam">{{ $errors->first('title') }}</span>
                                                            @endif
                                                        </div>

                                                    </div>

                                                    {{-- slug ------------------------------------------------------------------------------------- --}}
                                                    {{-- Start Slug --}}
                                                    <div class="row mb-3 slug-section">
                                                        <label for="example-text-input" class="col-sm-2 col-form-label">slug</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" id="slug" name="slug" value="{{ old('slug') }}" class="form-control slug" required>
                                                            @if ($errors->has('slug'))
                                                            <span class="missiong-spam">{{ $errors->first('slug') }}</span>
                                                            @endif
                                                        </div>
                                                        @include('admin.layouts.scriptSlug')
                                                        {{-- End Slug --}}



                                                        <div class="row mt-3">
                                                            <label for="example-text-input" class="col-sm-2 col-form-label">
                                                               المحتوي </label>
                                                            <div class="col-sm-10 mb-2">
                                                                <textarea id="content" name="content" class="m-auto form-control " style="margin-top: 10px"> {{ old(  'content') }} </textarea>
                                                                @if ($errors->has(  'content'))
                                                                <span class="missiong-spam">{{ $errors->first(  'content') }}</span>
                                                                @endif
                                                            </div>


{{--                                                            <script type="text/javascript">--}}
{{--                                                                CKEDITOR.replace('content', {--}}
{{--                                                                    filebrowserUploadUrl: "{{ route('admin.ckeditor.upload', ['_token' => csrf_token()]) }}"--}}
{{--                                                                    , filebrowserUploadMethod: 'form'--}}
{{--                                                                });--}}

{{--                                                            </script>--}}
                                                            <script type="text/javascript">
                                                                $(function () {
                                                                    CKEDITOR.replace('content');
                                                                    $('textarea').wysihtml5()
                                                                })

                                                            </script>

                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="accordion mt-4 mb-4" id="accordionExample">
                                        <div class="accordion-item border rounded">
                                            <h2 class="accordion-header" id="headingTwo">
                                                <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                    اعدادات ميتا
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse show mt-3" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">


                                                    {{-- meta_title_ ------------------------------------------------------------------------------------- --}}
                                                    <div class="row mb-3">
                                                        <label for="example-text-input" class="col-sm-2 col-form-label">عنوان ميتا</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" type="text" name="meta_title" value="{{ old('meta_title') }}" id="title">
                                                        </div>
                                                        @if ($errors->has(  'meta_title'))
                                                        <span class="missiong-spam">{{ $errors->first(  'meta_title') }}</span>
                                                        @endif
                                                    </div>

                                                    {{-- meta_description_ ------------------------------------------------------------------------------------- --}}
                                                    <div class="row mb-3">
                                                        <label for="example-text-input" class="col-sm-2 col-form-label"> وصف ميتا
                                                        </label>
                                                        <div class="col-sm-10 mb-2">
                                                            <textarea name="meta_description" class="form-control description"> {{ old(  'meta_description') }} </textarea>
                                                            @if ($errors->has( 'meta_description'))
                                                            <span class="missiong-spam">{{ $errors->first('meta_description') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    {{-- meta_key_ ------------------------------------------------------------------------------------- --}}
                                                    <div class="row mb-3">
                                                        <label for="example-text-input" class="col-sm-2 col-form-label"> مفتاح ميتا
                                                        </label>
                                                        <div class="col-sm-10 mb-2">
                                                            <textarea name="meta_key" class="form-control description"> {{ old('meta_key') }} </textarea>
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

                                                    {{-- image ------------------------------------------------------------------------------------- --}}
                                                    <div class="col-12">
                                                        <div class="row mb-3">
                                                            <label for="example-number-input" class="col-sm-12 col-form-label" l>
                                                               الصورة : </label>
                                                            <div class="col-sm-12">
                                                                <input class="form-control" type="file" placeholder="اضف صورة:" id="example-number-input" name="image" value="{{ old('image') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- Status ------------------------------------------------------------------------------------- --}}
                                                    <div class="col-12">
                                                        <label class="col-sm-12 col-form-label" for="available">الحالة</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-check form-switch" name="status" type="checkbox" id="switch3" switch="success" checked value="1">
                                                            <label class="form-label" for="switch3" data-on-label=" نعم " data-off-label=" لا"></label>
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
                                    <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-primary waves-effect waves-light ml-3 btn-sm">رجوع</a>
                                    <button type="submit" class="btn btn-outline-success waves-effect waves-light ml-3 btn-sm">حفظ</button>
                                </div>
                            </div>
                        </form>
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
<script src="https://cdn.ckeditor.com/4.5.6/standard/ckeditor.js"></script>
@endsection
