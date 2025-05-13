@extends('admin.layout')

@section('title', trans('admin.cities_show'))
@section('title_page', trans('admin.cities_show'))
@section('title_route', route('admin.cities.index') )
@section('button_page')
<a href="{{ route('admin.cities.index') }}" class="btn btn-outline-primary waves-effect waves-light ml-3 btn-sm">@lang('button.cancel')</a>
@endsection

@section('content')

<div class="row">
    <div class="col-12 m-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        {{-- name_ar ------------------------------------------------------------------------------------- --}}
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="example-text-input" class="col-sm-12 col-form-label">{{ trans('admin.title_in') }} Arabic</label>
                                <div class="col-sm-12">
                                    <input class="form-control" type="text" name="name_ar" disabled readonly value="{{ @$district->name_ar }}" />
                                </div>
                            </div>

                            {{-- name_en ------------------------------------------------------------------------------------- --}}
                            <div class="col-md-6">
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-12 col-form-label">{{ trans('admin.title_in')  }} English</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" name="name_en" disabled readonly value="{{ @$district->name_en }}" </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-6">
                        <label for="example-text-input" class="col-sm-12 col-form-label">{{ trans('admin.city')  }}</label>
                        <div class="col-sm-12">
                            <input class="form-control" type="text" name="name_en" disabled readonly value="{{ @$district->city->name }}" </div>
                        </div>
                    </div>
                    {{-- Status ------------------------------------------------------------------------------------- --}}
                    <div class="col-md-6">
                        <div class="col-12">
                            <label class="col-sm-12 col-form-label" for="available">{{ trans('admin.status') }}</label>
                            <div class="col-sm-10">
                                <div class="col-sm-10">
                                    <input class="form-check form-switch" name="status" type="checkbox" id="switch3" switch="success" {{ @$district->status == 1 ? 'checked' : '' }} value="1" disabled>
                                    <label class="form-label" for="switch3" data-on-label=" نعم " data-off-label=" لا"></label>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="col-12">
                        {{-- Butoooons ------------------------------------------------------------------------- --}}
                        <div class="row mb-3 text-end">
                            <div>
                                <a href="{{ route('admin.districts.index') }}" class="btn btn-outline-primary waves-effect waves-light ml-3 btn-sm">@lang('button.cancel')</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div> <!-- container-fluid -->

@endsection
