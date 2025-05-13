@extends('admin.layout')

@section('title', " تعديل مدير رئيسي " . @$super_admin->name)
@section('title_page',   " تعديل مدير رئيسي "  . @$super_admin->name )


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
                            <form action="{{ route('admin.super_admins.update', $super_admin->id) }}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('put')
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


                                                        {{-- name ------------------------------------------------------------------------------------- --}}
                                                        <div class="row mb-3">
                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label"> الاسم </label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control" type="text" name="name"
                                                                       value="{{ @$super_admin->name }}" id="title">
                                                            </div>
                                                            @if ($errors->has( 'name'))
                                                                <span
                                                                    class="missiong-spam">{{ $errors->first( 'name') }}</span>
                                                            @endif
                                                        </div>

                                                        {{-- email ------------------------------------------------------------------------------------- --}}

                                                        <div class="row mb-3 email-section">
                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label"> الجوال </label>

                                                            <div class="col-sm-10">
                                                                <input type="text" id="mobile" name="mobile"
                                                                       value="{{ @$super_admin->mobile }}"
                                                                       class="form-control email mb-3" required>
                                                                @if ($errors->has( 'mobile'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first( 'mobile') }}</span>
                                                                @endif
                                                            </div>

                                                            {{-- End Slug --}}


                                                        </div>


                                                        {{-- Start Slug --}}
                                                        <div class="row mb-3 email-section">
                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label"> البريد الالكتروني </label>

                                                            <div class="col-sm-10">
                                                                <input type="text" id="email" name="email"
                                                                       value="{{ @$super_admin->email }}"
                                                                       class="form-control email mb-3" required>
                                                                @if ($errors->has( 'email'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first( 'email') }}</span>
                                                                @endif
                                                            </div>

                                                            {{-- End Slug --}}


                                                        </div>



                                                        <div class="row mb-3 email-section">
                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label"> كلمة المرور </label>

                                                            <div class="col-sm-10">
                                                                <input type="password" id="password" name="password"
                                                                       value=""
                                                                       class="form-control  mb-3"    >
                                                                @if ($errors->has( 'password'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first( 'password') }}</span>
                                                                @endif
                                                            </div>

                                                            {{-- End Slug --}}


                                                        </div>



                                                    </div>
                                                </div>
                                            </div>


                                            {{--                                        /////////--}}


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
                                                        <div class="col-sm-3 mb-3">
                                                            <img src="{{ asset($super_admin->pathInView('super_admins')) }}" alt=""
                                                                 style="width:100%">

                                                        </div>
                                                        {{-- image ------------------------------------------------------------------------------------- --}}
                                                        <div class="col-12">
                                                            <div class="row mb-3">
                                                                <label for="example-number-input" col-form-label>
                                                                    الصورة :</label>
                                                                <div class="col-sm-12">
                                                                    <input class="form-control" type="file"
                                                                           placeholder="@lang('admin.image'):"
                                                                           id="example-number-input" name="image"
                                                                           value="{{ old('image') }}">
                                                                </div>
                                                            </div>
                                                        </div>



                                                        {{-- Status ------------------------------------------------------------------------------------- --}}
{{--                                                        <div class="col-12">--}}
{{--                                                            <label class="col-sm-12 col-form-label" for="available">--}}
{{--                                                                الحالة </label>--}}
{{--                                                            <div class="col-sm-10">--}}
{{--                                                                <input class="form-check form-switch" name="status"--}}
{{--                                                                       type="checkbox" id="switch3" switch="success"--}}
{{--                                                                       {{ @$super_admin->status == 1 ? 'checked' : '' }} value="1">--}}
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
                                           class="btn btn-outline-danger waves-effect waves-light ml-3 btn-sm">
                                            رجوع </a>
                                        <button type="submit"
                                                class="btn btn-outline-success waves-effect waves-light ml-3 btn-sm">
                                            حفظ
                                        </button>
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
    <<script src="https://cdn.ckeditor.com/4.5.6/full/ckeditor.js"></script>
@endsection
