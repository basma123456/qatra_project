@extends('admin.layout')

@section('title',  "البنرات")
@section('title_ad',  "تعديل البنرات " .  @$ad->title  )

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="row">
                <div class="col-12 m-3">
                    <div class="row mb-3 text-end">
                        <div>
                            <a href="{{ route('admin.ads.index') }}"
                               class="btn btn-outline-primary waves-effect waves-light ml-3 btn-sm
                                btn-sm">رجوع</a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">

                            <form action="{{ route('admin.ads.update', $ad->id)  }}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-8">

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
                                                                       class="col-sm-2 col-form-label"> العنوان </label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control" type="text"
                                                                           name="title"
                                                                           value="{{ @$ad->title }}"
                                                                           id="title">
                                                                </div>
                                                                @if ($errors->has('title'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first( 'title') }}</span>
                                                                @endif
                                                            </div>

                                                            {{-- slug ------------------------------------------------------------------------------------- --}}
                                                            {{-- Start Slug --}}
                                                            <div class="row mb-3 slug-section">
                                                                <label for="example-text-input"
                                                                       class="col-sm-2 col-form-label">  Slug </label>

                                                                <div class="col-sm-10">
                                                                    <input type="text" id="slug"
                                                                           name="slug"
                                                                           value="{{ @$ad->slug }}"
                                                                           class="form-control slug mb-2" required>
                                                                    @if ($errors->has( 'slug'))
                                                                        <span
                                                                            class="missiong-spam">{{ $errors->first('slug') }}</span>
                                                                    @endif
                                                                </div>
                                                                @include('admin.layouts.scriptSlug')
                                                                {{-- End Slug --}}


                                                                {{-- description ------------------------------------------------------------------------------------- --}}
                                                                <div class="row mb-3">
                                                                    <label for="example-text-input"
                                                                           class="col-sm-2 col-form-label">
                                                                        الوصف  </label>
                                                                    <div class="col-sm-10 mb-2">
                                                                        <textarea id="description" class="form-control description"
                                                                                  name="description"> {{ @$ad->description }} </textarea>
                                                                        @if ($errors->has('description'))
                                                                            <span
                                                                                class="missiong-spam">{{ $errors->first('description') }}</span>
                                                                        @endif
                                                                    </div>
                                                                    <script type="text/javascript">
                                                                        $(function () {
                                                                            CKEDITOR.replace('description');
                                                                            $('textarea').wysihtml5()
                                                                        })
                                                                    </script>
                                                                </div>




                                                                {{-- content ------------------------------------------------------------------------------------- --}}
{{--                                                                <div class="row mb-3">--}}
{{--                                                                    <label for="example-text-input"--}}
{{--                                                                           class="col-sm-2 col-form-label">--}}
{{--                                                                        المحتوي </label>--}}
{{--                                                                    <div class="col-sm-10 mb-2">--}}
{{--                                                                        <textarea id="content" class="form-control description"--}}
{{--                                                                                  name="content"> {{ @$ad->content }} </textarea>--}}
{{--                                                                        @if ($errors->has('content'))--}}
{{--                                                                            <span--}}
{{--                                                                                class="missiong-spam">{{ $errors->first('content') }}</span>--}}
{{--                                                                        @endif--}}
{{--                                                                    </div>--}}
{{--                                                                    <script type="text/javascript">--}}
{{--                                                                        $(function () {--}}
{{--                                                                            CKEDITOR.replace('content');--}}
{{--                                                                            $('textarea').wysihtml5()--}}
{{--                                                                        })--}}
{{--                                                                    </script>--}}
{{--                                                                </div>--}}


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="accordion mt-4 mb-4" id="accordionExample">
                                                    <div class="accordion-item border rounded">
                                                        <h2 class="accordion-header" id="headingTwo">
                                                            <button class="accordion-button fw-medium" type="button"
                                                                    data-bs-toggle="collapse"
                                                                    data-bs-target="#collapseTwo"
                                                                    aria-expanded="true"
                                                                    aria-controls="collapseTwo">
                                                                اعدادات الميتا
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
                                                                                   value="{{ @$ad->meta_title }}"
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
                                                                               class="col-sm-2 col-form-label"> وصف الميتا
                                                                        </label>
                                                                        <div class="col-sm-10 mb-2">
                                                                            <textarea
                                                                                name="meta_description"
                                                                                class="form-control description"> {{ @$ad->meta_description }} </textarea>
                                                                            @if ($errors->has('meta_description'))
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
                                                                                      class="form-control description"> {{ @$ad->meta_key }} </textarea>
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
                                                            aria-expanded="true"
                                                            aria-controls="collapseOne">
                                                        الاعدادات
                                                    </button>
                                                </h2>

                                                <div id="collapseOne" class="accordion-collapse collapse show"
                                                     aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                        <div class="col-sm-6 mb-3">

                                                                <img src="{{ asset($ad->pathInView()) }}" alt=""
                                                                     style="width:100%">

                                                        </div>
                                                        <div class="col-sm-6 mb-3">

                                                            <img src="{{ asset($ad->getLogo()) }}" alt=""
                                                                 style="width:100%">

                                                        </div>
                                                        </div>


                                                        {{-- image ------------------------------------------------------------------------------------- --}}
                                                        <div class="col-12">
                                                            <div class="row mb-3">
                                                                <label for="example-number-input" col-form-label>
                                                                     الصورة :</label>
                                                                <div class="col-sm-12">
                                                                    <input class="form-control" type="file"
                                                                           placeholder="الصورة : "
                                                                           id="example-number-input"
                                                                           name="image" value="{{ old('image') }}">
                                                                </div>
                                                            </div>
                                                        </div>


                                                        {{-- logo ------------------------------------------------------------------------------------- --}}
                                                        <div class="col-12">
                                                            <div class="row mb-3">
                                                                <label for="example-number-input" col-form-label>
                                                                    اللوجو :</label>
                                                                <div class="col-sm-12">
                                                                    <input class="form-control" type="file"
                                                                           placeholder="اللوجو : "
                                                                           id="example-number-input"
                                                                           name="logo" value="{{ old('logo') }}">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- show_logo_status ------------------------------------------------------------------------------------- --}}
                                                        <div class="col-12">
                                                            <label class="col-sm-12 col-form-label"
                                                                   for="available">حالة اظهار اللوجو</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-check form-switch" name="show_logo_status"
                                                                       type="checkbox"
                                                                       id="switchshow_logo_status" switch="success"
                                                                       {{ @$ad->show_logo_status == 1 ? 'checked' : '' }} value="1">
                                                                <label class="form-label" for="switchshow_logo_status"
                                                                       data-on-label=" نعم "
                                                                       data-off-label=" لا"></label>
                                                            </div>
                                                        </div>


                                                        <div class="col-12">
                                                            <div class="row mb-3">
                                                                <label for="example-number-input" class="col-sm-12 col-form-label"  >
                                                                    الرابط الخارجي : </label>
                                                                <div class="col-sm-12">
                                                                    <input class="form-control" type="text" placeholder="اضف الرابط:" id="example-number-input" name="link" value="{{ $ad->link ?? old('link') }}">
                                                                </div>
                                                            </div>
                                                        </div>



                                                        {{-- Status ------------------------------------------------------------------------------------- --}}
                                                        <div class="col-12">
                                                            <label class="col-sm-12 col-form-label"
                                                                   for="available">الحالة</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-check form-switch" name="status"
                                                                       type="checkbox"
                                                                       id="switch3" switch="success"
                                                                       {{ @$ad->status == 1 ? 'checked' : '' }} value="1">
                                                                <label class="form-label" for="switch3"
                                                                       data-on-label=" نعم "
                                                                       data-off-label=" لا"></label>
                                                            </div>
                                                        </div>


                                                        {{-- feature ------------------------------------------------------------------------------------- --}}
                                                        <div class="col-12">
                                                            <label class="col-sm-12 col-form-label"
                                                                   for="available">الميزة</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-check form-switch" name="feature"
                                                                       type="checkbox"
                                                                       id="feature" switch="success"
                                                                       {{ @$ad->feature == 1 ? 'checked' : '' }} value="1">
                                                                <label class="form-label" for="feature"
                                                                       data-on-label=" نعم "
                                                                       data-off-label=" لا"></label>
                                                            </div>
                                                        </div>








                                                        <div class="col-12">
                                                            <label class="col-sm-12 col-form-label"
                                                                   for="available"> تفعيل خاصية تغيير اللون</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-check form-switch"
                                                                       name="giveTransparentColorid"
                                                                       id="giveTransparentColorid"
                                                                       type="checkbox"
                                                                       onchange="giveTransparentColor(this)"
                                                                       switch="success"
                                                                       @if($ad->bg_color != "transparent" && isset($ad->bg_color))
                                                                       checked
                                                                       @endif
                                                                       value="1">

                                                                <label class="form-label" for="giveTransparentColorid"
                                                                       data-on-label="  نعم "
                                                                       data-off-label=" لا"></label>
                                                            </div>
                                                        </div>

                                                        <input type="hidden" name="bg_color" id="transparent"
                                                               value="transparent" disabled>

                                                        <div id="background_container_whole">
                                                            @if($ad->bg_color != "transparent" && isset($ad->bg_color))



                                                                {{-- show recent back ground ------------------------------------------------------------------------------------- --}}
                                                                <div class="col-12 background_container_whole">
                                                                    <label class="col-sm-12 col-form-label"
                                                                           for="show_recent_back_ground_color">


                                                                        اللون الحالي للخلفية</label>
                                                                    <div class="col-sm-10">
                                                                        <!-- Button trigger modal -->
                                                                        <button type="button"
                                                                                class="btn btn-outline-primary"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#exampleModal">
                                                                            عرض
                                                                        </button>

                                                                        <!-- Modal -->
                                                                        <div class="modal fade" id="exampleModal"
                                                                             tabindex="-1"
                                                                             aria-labelledby="exampleModalLabel"
                                                                             aria-hidden="true">
                                                                            <div class="modal-dialog">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title"
                                                                                            id="exampleModalLabel">
                                                                                            لون الخلفية </h5>
                                                                                        <button type="button"
                                                                                                class="btn-close"
                                                                                                data-bs-dismiss="modal"
                                                                                                aria-label="Close"></button>
                                                                                    </div>
                                                                                    <div class="modal-body ">
                                                                                        <div
                                                                                            style="margin: auto; width: 100%; height: 30vh;  background-color: {{$ad->bg_color}} !important; ">
                                                                                            <br></div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button"
                                                                                                class="btn btn-secondary"
                                                                                                data-bs-dismiss="modal">
                                                                                            اغلاق
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif

                                                            {{-- Status of back ground ------------------------------------------------------------------------------------- --}}
                                                            <div class="col-12 background_container_whole">
                                                                <label class="col-sm-12 col-form-label"
                                                                       for="back_ground_color_status">تغيير اللون الحالي
                                                                    للخلفية</label>
                                                                <div class="col-sm-10">
                                                                    <input onchange="bgColorStatus(this)"
                                                                           class="form-check form-switch"
                                                                           type="checkbox"
                                                                           id="back_ground_color_status"
                                                                           name="back_ground_color_status" switch="true"
                                                                           value="1">
                                                                    <label class="form-label"
                                                                           for="back_ground_color_status"
                                                                           data-on-label=" نعم "
                                                                           data-off-label=" لا"></label>
                                                                </div>
                                                            </div>

                                                            {{-- back ground color ------------------------------------------------------------------------------------- --}}
                                                            <div class="col-12 background_container_whole"
                                                                 style="visibility: hidden"
                                                                 id="background_container">
                                                                <label class="col-sm-12 col-form-label"
                                                                       for="bg_color">اختر لون الخلفية</label>
                                                                <div class="col-sm-10">
                                                                    <input disabled="disabled" class="form-control"
                                                                           name="bg_color"
                                                                           id="back_ground_color"
                                                                           type="color"
                                                                           value="">
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
                                        <a href="{{ route('admin.ads.index') }}"
                                           class="btn btn-outline-primary waves-effect waves-light ml-3 btn-sm">رجوع</a>
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


    <script>

        window.onLoad(giveTransparentColor(document.querySelector('#giveTransparentColorid')))


        function bgColorStatus(obj) {
            if (obj.checked == true) {

                document.getElementById('background_container').style.visibility = "visible";
                document.getElementById('back_ground_color').removeAttribute('disabled');
            } else {
                document.getElementById('background_container').style.visibility = "hidden";
                document.getElementById('back_ground_color').setAttribute('disabled', "disabled");

            }
        }


        function giveTransparentColor(obj) {
            if (obj.checked === true) {

                document.getElementById('transparent').setAttribute('disabled', "disabled");
                document.getElementById('background_container_whole').style.visibility = "visible";

                // document.getElementsByClassName('background_container_whole').forEach(function (item) {
                //     item.style.visibility = "visible !important";
                // });


            } else {
                document.getElementById('transparent').removeAttribute('disabled');
                document.getElementById('background_container_whole').style.visibility = "hidden";

                // document.getElementsByClassName('background_container_whole').style.visibility = "hidden";
                // document.getElementsByClassName('background_container_whole').forEach(function (item) {
                //     item.style.visibility = "hidden !important";
                // });
                // // document.getElementById('back_ground_color').setAttribute('disabled' , 'disabled');
            }
        }

        //

    </script>


@endsection


@section('style')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.5.6/standard/ckeditor.js"></script>
@endsection
