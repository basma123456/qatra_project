@extends('admin.layout')

@section('title', "مدير رئيسي " . @$admin->name)
@section('title_page',   "مدير رئيسي " . @$admin->name )

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="row">
                <div class="col-12 m-3">
                    <div class="row mb-3 text-end">
                        <div>
                            <a href="{{ route('admin.admins.index') }}" class="btn btn-outline-primary waves-effect waves-light ml-3 btn-sm">رجوع</a>
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


                                                        {{-- name ------------------------------------------------------------------------------------- --}}
                                                        <div class="row mb-3">
                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label"> الاسم </label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control" type="text" name="name"
                                                                     disabled  value="{{ @$admin->name }}" id="name">
                                                            </div>
                                                            @if ($errors->has( 'name'))
                                                                <span
                                                                    class="missiong-spam">{{ $errors->first( 'name') }}</span>
                                                            @endif
                                                        </div>

                                                        {{-- slug ------------------------------------------------------------------------------------- --}}
                                                        {{-- Start Slug --}}
                                                        <div class="row mb-3 slug-section">
                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label"> الجوال </label>

                                                            <div class="col-sm-10">
                                                                <input type="text" id="mobile" name="mobile"
                                                                       disabled    value="{{ @$admin->mobile }}"
                                                                       class="form-control  mb-3" >
                                                                @if ($errors->has( 'mobile'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first( 'mobile') }}</span>
                                                                @endif
                                                            </div>

                                                            {{-- End Slug --}}
                                                            {{-- description ------------------------------------------------------------------------------------- --}}
                                                            <div class="row mb-3">
                                                                <label for="example-text-input"
                                                                       class="col-sm-2 col-form-label"> البريد الالكتروني </label>
                                                                <div class="col-sm-10 mb-2">
                                                                    <input id="email"   disabled class="form-control"
                                                                          value="{{ @$admin->email }}"    name="email">
                                                                    @if($errors->has(  'email'))
                                                                        <span
                                                                            class="missiong-spam">{{ $errors->first(  'email') }}</span>
                                                                    @endif
                                                                </div>




                                                            </div>
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

                                                            <img src="{{ asset($admin->pathInView('admins')) }}" alt=""
                                                                 style="width:100%">

                                                        </div>



                                                        {{-- Status ------------------------------------------------------------------------------------- --}}
{{--                                                        <div class="col-12 ">--}}
{{--                                                            <label class="col-md-3 col-form-label" for="status"> الحالة </label>--}}
{{--                                                            @if(@$admin->status == 1 )--}}
{{--                                                                <p class="badge  bg-success h3" style="font-size:20px">نعم</p>--}}
{{--                                                            @else--}}
{{--                                                                <p class="badge  bg-danger h3" style="font-size:20px">لا</p>--}}
{{--                                                            @endif--}}
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
                                        <a href="{{ route('admin.admins.index') }}"
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
    <<script src="https://cdn.ckeditor.com/4.5.6/full/ckeditor.js"></script>
@endsection
