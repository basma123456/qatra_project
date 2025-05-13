@extends('admin.layout')

@section('title', "اراء العملاء")
@section('title_review', " رأي العميل  " .  @$review->title  )

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="row">
                <div class="col-12 m-3">
                    <div class="row mb-3 text-end">
                        <div>
                            <a href="{{ route('admin.reviews.index') }}"
                                class="btn btn-outline-primary waves-effect waves-light ml-3 btn-sm">رجوع</a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">

                            <div  >
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
                                                                class="col-sm-2 col-form-label">العنوان</label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control" type="text"
                                                                        name="name"
                                                                        value="{{ @$review->name }}"
                                                                        id="name" disabled>
                                                                </div>
                                                                @if ($errors->has('name'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first('name') }}</span>
                                                                @endif
                                                            </div>

                                                            {{-- slug ------------------------------------------------------------------------------------- --}}
                                                            {{-- Start Slug --}}
                                                            <div class="row mb-3 slug-section">


                                                                {{-- description ------------------------------------------------------------------------------------- --}}
                                                                <div class="row mb-3">
                                                                    <label for="example-text-input"
                                                                    class="col-sm-2 col-form-label">
                                                                    الوصف </label>
                                                                    <div class="col-sm-10 mb-2">
                                                                        <textarea id="description" name="description" disabled> {{ @$review->description }} </textarea>
                                                                        @if ($errors->has('description'))
                                                                            <span
                                                                                class="missiong-spam">{{ $errors->first('description') }}</span>
                                                                        @endif
                                                                    </div>

                                                                    <script type="text/javascript">
                                                                        $(function() {
                                                                            CKEDITOR.replace('description');
                                                                            $('.textarea').wysihtml5()
                                                                        })
                                                                    </script>

                                                                </div>


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
                                                                        name="meta_title]"
                                                                        value="{{ @$review->meta_title }}"
                                                                        id="title" disabled>
                                                                </div>
                                                                @if ($errors->has('meta_title'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first('meta_title') }}</span>
                                                                @endif
                                                            </div>

                                                            {{-- meta_description_ ------------------------------------------------------------------------------------- --}}
                                                            <div class="row mb-3">
                                                                <label for="example-text-input"
                                                                class="col-sm-2 col-form-label"> وصف ميتا
                                                                </label>
                                                                <div class="col-sm-10 mb-2">
                                                                    <textarea name="meta_description" class="form-control description" disabled> {{ @$review->meta_description }} </textarea>
                                                                    @if ($errors->has('meta_description'))
                                                                        <span
                                                                            class="missiong-spam">{{ $errors->first('meta_description') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            {{-- meta_key_ ------------------------------------------------------------------------------------- --}}
                                                            <div class="row mb-3">
                                                                <label for="example-text-input"
                                                                class="col-sm-2 col-form-label"> مفتاح ميتا
                                                                </label>
                                                                <div class="col-sm-10 mb-2">
                                                                    <textarea name="meta_key" class="form-control description" disabled> {{ @$review->meta_key }} </textarea>
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
                                </div>
                                    <div class="col-md-4">

                                        <div class="accordion mt-4 mb-4" id="accordionExample">
                                            <div class="accordion-item border rounded">
                                                <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button fw-medium" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                                            aria-controls="collapseOne">
                                                        الاعدادات
                                                    </button>
                                                </h2>
                                                <div id="collapseOne" class="accordion-collapse collapse show"
                                                     aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="col-sm-3 mb-3">

                                                                <img src="{{ asset($review->pathInView()) }}" alt=""
                                                                     style="width:100%">

                                                        </div>



                                                        {{-- Status ------------------------------------------------------------------------------------- --}}
                                                        <div class="col-12">
                                                            <label class="col-sm-12 col-form-label"
                                                                   for="available">الحالة</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-check form-switch" name="status" type="checkbox"
                                                                       id="switch3" switch="success"
                                                                       {{ @$review->status == 1 ? 'checked' : '' }} value="1" disabled>
                                                                <label class="form-label" for="switch3"
                                                                       data-on-label=" نعم "
                                                                       data-off-label=" لا"></label>
                                                            </div>
                                                        </div>


                                                        {{-- Feature ------------------------------------------------------------------------------------- --}}
                                                        <div class="col-12">
                                                            <label class="col-sm-12 col-form-label"
                                                                   for="available">الميزة</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-check form-switch" name="feature" type="checkbox"
                                                                       id="feature" switch="success"
                                                                       {{ @$review->feature == 1 ? 'checked' : '' }} value="1" disabled>
                                                                <label class="form-label" for="feature"
                                                                       data-on-label=" نعم "
                                                                       data-off-label=" لا"></label>
                                                            </div>
                                                        </div>


                                                        {{-- Status ------------------------------------------------------------------------------------- --}}
                                                        <div class="col-12">
                                                            <label class="col-sm-12 col-form-label"
                                                                   for="available">النوع</label>
                                                            <div class="col-sm-10">
                                                                <select class="form-control" disabled
                                                                        id="gender">
                                                                    <option {{$review->gender === 0 ? 'selected' : ''}} value="0">ذكر</option>
                                                                    <option {{$review->gender === 1 ? 'selected' : ''}} value="1">انثي</option>
                                                                </select>
                                                            </div>
                                                        </div>



                                                        {{-- rate ------------------------------------------------------------------------------------- --}}
                                                        <div class="col-12">
                                                            <label class="col-sm-12 col-form-label"
                                                                   for="rate">التقييم</label>
                                                            <div class="col-sm-10">
                                                                <select class="form-control" disabled name="rate"
                                                                        id="rate">
                                                                    <option
                                                                        {{ +(old('rate')??$review->rate) === 1 ? 'selected' : ''}} value="1">
                                                                        1
                                                                    </option>
                                                                    <option
                                                                        {{ +(old('rate')??$review->rate)  === 2 ? 'selected' : ''}} value="2">
                                                                        2
                                                                    </option>
                                                                    <option
                                                                        {{ +(old('rate')??$review->rate)  === 3 ? 'selected' : ''}} value="3">
                                                                        3
                                                                    </option>
                                                                    <option
                                                                        {{ +(old('rate')??$review->rate)  === 4 ? 'selected' : ''}} value="4">
                                                                        4
                                                                    </option>
                                                                    <option
                                                                        {{ +(old('rate')??$review->rate)  === 5 ? 'selected' : ''}} value="5">
                                                                        5
                                                                    </option>

                                                                </select>
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
                            <a href="{{ route('admin.reviews.index') }}"
                            class="btn btn-outline-primary waves-effect waves-light ml-3 btn-sm">رجوع</a>

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
    <script src="https://cdn.ckeditor.com/4.5.6/standard/ckeditor.js"></script>
@endsection
