@extends('admin.layout')

@section('title', trans('admin.districts_edit'))
@section('title_page', trans('admin.districts_edit'))

@section('title_route', route('admin.districts.index') )

@section('button_page')
<a href="{{ route('admin.districts.index') }}" class="btn btn-outline-primary waves-effect waves-light ml-3 btn-sm">@lang('button.cancel')</a>
@endsection

@section('content')

<div class="row">
    <div class="col-12 m-3">
        <div class="card">
            <div class="card-body">

                <form action="{{ route('admin.districts.update', $district->id)  }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            {{-- name_ar ------------------------------------------------------------------------------------- --}}
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="example-text-input" class="col-sm-12 col-form-label">{{ trans('admin.title_in') }} Arabic</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" name="name_ar" value="{{ @$district->name_ar }}" </div>
                                        @if ($errors->has('name_ar'))
                                        <span class="missiong-spam">{{ $errors->first('name_ar') }}</span>
                                        @endif
                                    </div>
                                </div>

                                {{-- name_en ------------------------------------------------------------------------------------- --}}
                                <div class="col-md-6">
                                    <div class="row mb-3">
                                        <label for="example-text-input" class="col-sm-12 col-form-label">{{ trans('admin.title_in')  }} English</label>
                                        <div class="col-sm-12">
                                            <input class="form-control" type="text" name="name_en" value="{{ @$district->name_en }}" </div>
                                            @if ($errors->has('name_en'))
                                            <span class="missiong-spam">{{ $errors->first('name_en') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="example-text-input" class="col-sm-12 col-form-label">{{ trans('admin.city')  }}</label>

                            <select name="city_id" id="" class="form-select select2">
                                <option value=""></option>
                                @forelse($cities as $key => $city)
                                <option value="{{ $city->id }}" {{ $city->id == $district->city_id ? 'selected':' ' }}> {{ $city->name_ar }} | {{ $city->name_en }} </option>
                                @empty

                                @endforelse
                            </select>
                        </div>

                        <div class="col-md-6">

                            {{-- Status ------------------------------------------------------------------------------------- --}}
                            <div class="col-12">
                                <label class="col-sm-12 col-form-label" for="available">{{ trans('admin.status') }}</label>
                                <div class="col-sm-10">
                                    <div class="form-check form-switch form-check-success">
                                        <input class="form-check-input" type="checkbox" role="switch" name="status" {{  @$district->status == 1 ? 'checked' : '' }} id="flexSwitchCheckSuccessStatus">
                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="col-12">
                            {{-- Butoooons ------------------------------------------------------------------------- --}}
                            <div class="row mb-3 text-end">
                                <div>
                                    <a href="{{ route('admin.districts.index') }}" class="btn btn-outline-primary waves-effect waves-light ml-3 btn-sm">@lang('button.cancel')</a>
                                    <button type="submit" class="btn btn-outline-success waves-effect waves-light ml-3 btn-sm">@lang('button.save')</button>
                                    <button type="submit" name="submit" value="update" class="btn btn-outline-success waves-effect waves-light  btn-sm">@lang('button.save_update')</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

</div> <!-- container-fluid -->

@endsection
