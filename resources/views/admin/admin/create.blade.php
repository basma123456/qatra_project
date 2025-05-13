@extends('admin.layout')

@section('title', trans('admin.create_user'))
@section('title_page', trans('admin.create_new_user'))

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="row">
                <div class="col-12">
                    <div class="row mb-3 text-end">
                        <div>
                            <a href="{{ route('admin.admin.index') }}"
                                class="btn btn-outline-primary waves-effect waves-light ml-3 btn-sm">@lang('button.cancel')</a>
                        </div>
                    </div>
                    <div class="card">
                        <form action="{{ route('admin.admin.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row d-flex justify-content-center ">
                                <div class="col-md-6">

                                    <div class="accordion mt-4 mb-4 " id="accordionExample">
                                        <div class="accordion-item border rounded ">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button fw-medium" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseOne1"
                                                    aria-expanded="true" aria-controls="collapseOne1">
                                                    {{ trans('admin.create_user') }}
                                                </button>
                                            </h2>
                                            <div id="collapseOne1" class="accordion-collapse collapse show mt-3"
                                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">

                                                    <div class="row mb-3">
                                                        <label for="example-text-input"
                                                            class="col-sm-2 col-form-label">{{ trans('admin.name') }}</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control @error('name') is-invalid @enderror"
                                                                type="text" name="name" value="{{ old('name') }}">
                                                                @error('name')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="example-email-input"
                                                            class="col-sm-2 col-form-label">{{ trans('admin.email') }}</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control @error('email') is-invalid @enderror" type="email"
                                                                value="{{ old('email') }}" name="email">
                                                                @error('email')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="example-tel-input"
                                                            class="col-sm-2 col-form-label">{{ trans('admin.mobile') }}</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control @error('mobile') is-invalid @enderror" type="tel"
                                                                value="{{ old('mobile') }}" name="mobile">
                                                                @error('mobile')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="example-password-input"
                                                            class="col-sm-2 col-form-label">@lang('admin.password')</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control @error('password') is-invalid @enderror" type="password" name="password">
                                                            @error('password')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="example-password-input"
                                                            class="col-sm-2 col-form-label">@lang('admin.confirm_password')</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password"
                                                                name="password_confirmation">
                                                                @error('password_confirmation')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <div class="col-md-5">

                                    <div class="accordion mt-4 mb-4" id="accordionExample">
                                        <div class="accordion-item border rounded">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button fw-medium" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                    aria-expanded="true" aria-controls="collapseOne">
                                                    {{ trans('admin.settings') }}
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show"
                                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">

                                                    {{-- image ------------------------------------------------------------------------------------- --}}
                                                    <div class="col-12">
                                                        <div class="row mb-3">
                                                            <label for="example-number-input" col-form-label>
                                                                @lang('admin.image'):</label>
                                                            <div class="col-sm-12">
                                                                <input class="form-control" type="file"
                                                                    placeholder="@lang('admin.image'):"
                                                                    id="example-number-input" name="image"
                                                                    value="{{ old('image') }}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- ro ------------------------------------------------------------------------------------- --}}
                                                    <div class="col-12">
                                                        <div class="row mb-3">
                                                            <label class=" col-form-label"
                                                                for="available">@lang('admin.role')</label>
                                                            <div class="col-sm-12">
                                                                <select type="text" class="form-control select_2"
                                                                    multiple required id="role " name="roles[]">
                                                                    @foreach ($roles as $role)
                                                                        <option
                                                                            {{ $role->name == request('role') ? 'selected' : '' }}
                                                                            value="{{ $role->name }}">
                                                                            {{ $role->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- Status ------------------------------------------------------------------------------------- --}}
                                                    <div class="col-12">
                                                        <label class="col-sm-12 col-form-label"
                                                            for="available">{{ trans('admin.status') }}</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-check form-switch" name="status"
                                                                type="checkbox" id="switch3" switch="success" checked>
                                                            <label class="form-label" for="switch3"
                                                                data-on-label=" @lang('admin.yes') "
                                                                data-off-label=" @lang('admin.no')"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row mb-3 text-end ">
                                    <div>
                                        <a href="{{ route('admin.admin.index') }}"
                                            class="btn btn-outline-primary waves-effect waves-light btn-sm">@lang('button.cancel')</a>
                                        <button type="submit"
                                            class="btn btn-outline-success waves-effect waves-light btn-sm">@lang('button.save')</button>
                                    </div>
                                </div>

                            </div>

                         

                        </form>
                    </div>
                </div> <!-- end col -->
            </div>
        </div> <!-- end row-->




    </div> <!-- container-fluid -->

@endsection
@section('script')
    <!--tinymce js-->
    <script src="{{ asset('admin/assets/libs/tinymce/tinymce.min.js') }}"></script>

    <!-- init js -->
    <script src="{{ asset('admin/assets/js/pages/form-editor.init.js') }}"></script>

@endsection
