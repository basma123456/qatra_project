@extends('admin.layout')

@section('title', "اضافة سلايدر")
@section('title_page',  "اضافة سلايدر")

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="row">
                <div class="col-12 m-3">
                    <div class="row mb-3 text-end">
                        <div>
                            <a href="{{ route('admin.slider.index') }}"
                                class="btn btn-primary waves-effect waves-light ml-3 btn-sm">رجوع</a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">

                            <form action="{{ route('admin.slider.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-9">

                                            <div class="accordion mt-4 mb-4" id="accordionExample">
                                                <div class="accordion-item border rounded">
                                                    <h2 class="accordion-header" id="headingOne">
                                                        <button class="accordion-button fw-medium" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapseOne"
                                                            aria-expanded="true"
                                                            aria-controls="collapseOne">
                                                            البيانات
                                                        </button>
                                                    </h2>
                                                    <div id="collapseOne"
                                                        class="accordion-collapse collapse show mt-3"
                                                        aria-labelledby="headingOne"
                                                        data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">



                                                            {{-- title ------------------------------------------------------------------------------------- --}}
                                                            <div class="row mb-3">
                                                                <label for="example-text-input"
                                                                    class="col-sm-2 col-form-label">العنوان</label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control" type="text"
                                                                        name="title"
                                                                        value="{{ old(  'title') }}"
                                                                        id="title">
                                                                </div>
                                                                @if ($errors->has(  'title'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first(  'title') }}</span>
                                                                @endif
                                                            </div>
                                                            {{-- Start Slug --}}


                                                            {{-- description ------------------------------------------------------------------------------------- --}}
                                                            <div class="row mb-3">
                                                                <label for="example-text-input"
                                                                    class="col-sm-2 col-form-label">الوصف
                                                                </label>
                                                                <div class="col-sm-10 mb-2">
                                                                    <textarea id="description" name="description" class="form-control"
                                                                        rows="4"> {{ old(  'description') }} </textarea>
                                                                    @if ($errors->has(  'description'))
                                                                        <span
                                                                            class="missiong-spam">{{ $errors->first(  '.description') }}</span>
                                                                    @endif
                                                                </div>

                                                                {{-- <script type="text/javascript">
                                                                    $(function() {
                                                                        CKEDITOR.replace('description');
                                                                        $('.textarea').wysihtml5()
                                                                    })
                                                                </script> --}}

{{--                                                                <script type="text/javascript">--}}
{{--                                                                    CKEDITOR.replace('description', {--}}
{{--                                                                        filebrowserUploadUrl: "{{ route('admin.ckeditor.upload', ['_token' => csrf_token()]) }}",--}}
{{--                                                                        filebrowserUploadMethod: 'form'--}}
{{--                                                                    });--}}
{{--                                                                </script>--}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>


                                    <div class="col-md-3">

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
                                                        {{-- image ------------------------------------------------------------------------------------- --}}
                                                        <div class="col-12">
                                                            <div class="row mb-3">
                                                                <label for="example-number-input" col-form-label>
                                                                    الصورة :</label>
                                                                <div class="col-sm-12">
                                                                    <span class="text-danger">@lang('admin.image_site', ['width' => '1600px', 'height' => '750px'])</span>
                                                                    <input class="form-control" type="file"
                                                                        id="example-number-input" name="image"
                                                                        value="{{ old('image') }}">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- URL ------------------------------------------------------------------------------------- --}}
                                                        <div class="col-12">
                                                            <div class="row mb-3">
                                                                <label for="example-number-input" col-form-label>
                                                                   اللينك:</label>
                                                                <div class="col-sm-12">
                                                                    <input class="form-control" type="text"
                                                                        id="example-number-input" name="url"
                                                                        value="{{ old('url') }}">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- sort ------------------------------------------------------------------------------------- --}}
                                                        <div class="col-12">
                                                            <div class="row mb-3">
                                                                <label for="example-number-input" col-form-label>
                                                                   الترتيب:</label>
                                                                <div class="col-sm-12">
                                                                    <input class="form-control" type="number"
                                                                        id="example-number-input" name="sort"
                                                                        value="{{ old('sort') }}">
                                                                </div>
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
                                                                    data-off-label=" لا"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row mb-3 text-end">
                                        <div>
                                            <a href="{{ route('admin.slider.index') }}"
                                                class="btn btn-primary waves-effect waves-light ml-3 btn-sm">رجوع</a>
                                            <button type="submit"
                                                class="btn btn-outline-success waves-effect waves-light ml-3 btn-sm">حفظ</button>
                                        </div>
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
     <script src="{{ asset('assets/js/ckeditor/ckeditor.js') }}"></script>

    <script>
        $(document).ready(function() {
            $("#name_ar").on('keyup', function() {
                var Text = $(this).val();
                Text = Text.toLowerCase();
                Text = Text.replace(/[^a-zA-Z0-9ء-ي]+/g, '-');
                $("#slug_ar").val(Text);
            });


            $("#name_en").on('keyup', function() {
                var Text = $(this).val();
                Text = Text.toLowerCase();
                Text = Text.replace(/[^a-zA-Z0-9ء-ي]+/g, '-');
                $("#slug_en").val(Text);
            });
        });
    </script>
@endsection
