@extends('admin.layout')

@section('title', trans('settings.settings'))
@section('title_page', trans('settings.edit', ['name' => @$settingMain->key]) )


@section('style')
    {{-- @vite(['resources/assets/admin/css/data-tables.js']) --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <
    <script src="https://cdn.ckeditor.com/4.5.6/full/ckeditor.js"></script>
@endsection

@section('content')

    <div class="container-fluid">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="card">
                        <div class="card-body">

                            <!-- form start -->
                            <form class="form-horizontal"
                                  action="{{route('admin.settings.update-custom', $settingMain->key)}}" method="POST"
                                  enctype="multipart/form-data" role="form">
                                @csrf

                                <div class="row">
                                    <div class="col-md-12">

                                        <!--home page--->
                                        <div class="accordion mt-4 mb-4" id="accordionExample">
                                            <div class="accordion-item border rounded">
                                                <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button fw-medium" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapseOne"
                                                            aria-expanded="true"
                                                            aria-controls="collapseOne">
                                                        @lang('settings.home')
                                                    </button>
                                                </h2>
                                                <div id="collapseOne"
                                                     class="accordion-collapse collapse show mt-3"
                                                     aria-labelledby="headingOne"
                                                     data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">


                                                        {{-- meta_title_ ------------------------------------------------------------------------------------- --}}
                                                        <div class="row mb-3">
                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label">{{ trans('admin.meta_title_in')   }}</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control" type="text"
                                                                       name="home_meta_title_ar"
                                                                       value="{{ @$settings['home_meta_title_ar'] }}"
                                                                       id="titlear">
                                                            </div>
                                                        </div>

                                                        {{-- meta_description_ ------------------------------------------------------------------------------------- --}}
                                                        <div class="row mb-3">
                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label"> {{ trans('admin.meta_description_in')   }}
                                                            </label>
                                                            <div class="col-sm-10 mb-2">
                                                                    <textarea name="home_meta_description_ar"
                                                                              class="form-control description"> {{ @$settings['home_meta_description_ar' ] }} </textarea>

                                                            </div>
                                                        </div>

                                                        {{-- meta_key_ ------------------------------------------------------------------------------------- --}}
                                                        <div class="row mb-3">
                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label"> {{ trans('admin.meta_key_in')  }}
                                                            </label>
                                                            <div class="col-sm-10 mb-2">
                                                                    <textarea name="home_meta_key_ar"
                                                                              class="form-control description">   {{ @$settings['home_meta_key_ar'] }} </textarea>

                                                            </div>
                                                        </div>
                                                        <hr>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!--shop--->
                                        <div class="accordion mt-4 mb-4" id="accordionExampleshop">
                                            <div class="accordion-item border rounded">
                                                <h2 class="accordion-header" id="headingFourshop">
                                                    <button class="accordion-button fw-medium" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapseFourshop"
                                                            aria-expanded="true"
                                                            aria-controls="collapseFourshop">
                                                       المتجر
                                                    </button>
                                                </h2>
                                                <div id="collapseFourshop"
                                                     class="accordion-collapse collapse show mt-3"
                                                     aria-labelledby="headingFourshop"
                                                     data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">


                                                        {{--                                                        meta_title_ ---------------------------------------------------------------------------------------}}
                                                        <div class="row mb-3">
                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label">{{ trans('admin.meta_title_in')  }}</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control" type="text"
                                                                       name="shop_meta_title_ar"
                                                                       value="{{ @$settings['shop_meta_title_ar' ] }}"
                                                                       id="titlear">
                                                            </div>
                                                        </div>

                                                        {{--                                                        meta_description_ ---------------------------------------------------------------------------------------}}
                                                        <div class="row mb-3">
                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label"> {{ trans('admin.meta_description_in')  }}
                                                            </label>
                                                            <div class="col-sm-10 mb-2">
                                                                    <textarea name="shop_meta_description_ar"
                                                                              class="form-control description"> {{ @$settings['shop_meta_description_ar' ] }} </textarea>

                                                            </div>
                                                        </div>

                                                        {{--                                                        meta_key_ ---------------------------------------------------------------------------------------}}
                                                        <div class="row mb-3">
                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label"> {{ trans('admin.meta_key_in')  }}
                                                            </label>
                                                            <div class="col-sm-10 mb-2">
                                                                    <textarea name="shop_meta_key_ar"
                                                                              class="form-control description">   {{ @$settings['shop_meta_key_ar' ] }} </textarea>

                                                            </div>
                                                        </div>
                                                        <hr>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!---product--------->
                                        <div class="accordion mt-4 mb-4" id="accordionExampleproduct">
                                            <div class="accordion-item border rounded">
                                                <h2 class="accordion-header" id="headingFourproduct">
                                                    <button class="accordion-button fw-medium" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapseFourproduct"
                                                            aria-expanded="true"
                                                            aria-controls="collapseFourproduct">
                                                        المنتجات
                                                    </button>
                                                </h2>
                                                <div id="collapseFourproduct"
                                                     class="accordion-collapse collapse show mt-3"
                                                     aria-labelledby="headingFourproduct"
                                                     data-bs-parent="#accordionExampleproduct">
                                                    <div class="accordion-body">


                                                        {{-- meta_title_ ------------------------------------------------------------------------------------- --}}
                                                        <div class="row mb-3">
                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label">{{ trans('admin.meta_title_in')  }}</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control" type="text"
                                                                       name="product_meta_title_ar"
                                                                       value="{{ @$settings['product_meta_title_ar' ] }}"
                                                                       id="titlear">
                                                            </div>
                                                        </div>

                                                        {{-- meta_description_ ------------------------------------------------------------------------------------- --}}
                                                        <div class="row mb-3">
                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label"> {{ trans('admin.meta_description_in')  }}
                                                            </label>
                                                            <div class="col-sm-10 mb-2">
                                                                    <textarea
                                                                        name="product_meta_description_ar"
                                                                        class="form-control description"> {{ @$settings['product_meta_description_ar' ] }} </textarea>

                                                            </div>
                                                        </div>

                                                        {{-- meta_key_ ------------------------------------------------------------------------------------- --}}
                                                        <div class="row mb-3">
                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label"> {{ trans('admin.meta_key_in')  }}
                                                            </label>
                                                            <div class="col-sm-10 mb-2">
                                                                    <textarea name="product_meta_key_ar"
                                                                              class="form-control description">   {{ @$settings['product_meta_key_ar' ] }} </textarea>

                                                            </div>
                                                        </div>
                                                        <hr>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!--contact us--->
                                        <div class="accordion mt-4 mb-4" id="accordionExample">
                                            <div class="accordion-item border rounded">
                                                <h2 class="accordion-header" id="headingTree">
                                                    <button class="accordion-button fw-medium" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapseTree"
                                                            aria-expanded="true"
                                                            aria-controls="collapseTree">
                                                        @lang('settings.contact_us')
                                                    </button>
                                                </h2>
                                                <div id="collapseTree"
                                                     class="accordion-collapse collapse show mt-3"
                                                     aria-labelledby="headingTree"
                                                     data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">


                                                        {{-- meta_title_ ------------------------------------------------------------------------------------- --}}
                                                        <div class="row mb-3">
                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label">{{ trans('admin.meta_title_in')  }}</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control" type="text"
                                                                       name="contact_us_meta_title_ar"
                                                                       value="{{ @$settings['contact_us_meta_title_ar' ] }}"
                                                                       id="titlear">
                                                            </div>
                                                        </div>

                                                        {{-- meta_description_ ------------------------------------------------------------------------------------- --}}
                                                        <div class="row mb-3">
                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label"> {{ trans('admin.meta_description_in')  }}
                                                            </label>
                                                            <div class="col-sm-10 mb-2">
                                                                    <textarea
                                                                        name="contact_us_meta_description_ar"
                                                                        class="form-control description"> {{ @$settings['contact_us_meta_description_ar' ] }} </textarea>

                                                            </div>
                                                        </div>

                                                        {{-- meta_key_ ------------------------------------------------------------------------------------- --}}
                                                        <div class="row mb-3">
                                                            <label for="example-text-input"
                                                                   class="col-sm-2 col-form-label"> {{ trans('admin.meta_key_in')  }}
                                                            </label>
                                                            <div class="col-sm-10 mb-2">
                                                                    <textarea name="contact_us_meta_key_ar"
                                                                              class="form-control description">   {{ @$settings['contact_us_meta_key_ar' ] }} </textarea>

                                                            </div>
                                                        </div>
                                                        <hr>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                                <!-- /.card-body -->
                                <div class="card-footer text-end">
                                    <a href="{{ route('admin.settings.index') }}"
                                       class="btn btn-outline-danger waves-effect waves-light ml-3">@lang('button.cancel')</a>
                                    <button type="submit" class="btn btn-success">@lang('button.save')</button>
                                </div>
                                <!-- /.card-footer -->
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>

    </div> <!-- container-fluid -->

@endsection




@section('script')
    {{-- @vite(['resources/assets/admin/js/data-tables.js']) --}}
@endsection

