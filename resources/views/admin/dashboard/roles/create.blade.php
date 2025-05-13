@extends('admin.layout')

@section('title', trans('admin.roles_create'))
@section('title_page', trans('admin.roles_create'))

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/css/multi-select.min.css" />
    <style>
        .ms-container {
            width: 70%;
        }
    </style>
@endsection

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="row">
                <div class="col-12 m-3">
                    <div class="card">
                        <div class="card-body">

                            <h2 class="card-title">@lang('admin.roles_create')</h2>

                            <form action="{{ route('admin.roles.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label for="example-text-input"
                                        class="col-sm-2 col-form-label">@lang('admin.name')</label>
                                    <div class="col-sm-10">
                                        <input class="form-control  @error('name') is-invalid @enderror" type="text" placeholder="@lang('admin.name')"
                                            name="name" value="{{ old('name') }}">
                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="example-text-input"
                                        class="col-sm-2 col-form-label">@lang('admin.permissions')</label>
                                    <div class="col-sm-10">
                                        <div class="col-md-2">
                                            <input class="" type="checkbox" id="cheakAll">
    
                                            <label for="example-text-input" class="col-form-label">@lang('admin.cheak_all')</label>
                                        </div>
                                        <select id="permissions" class="form-control multi-select" multiple="multiple"
                                            required name="permissions[]">
                                            @foreach ($permissions as $item)
                                                <option value="{{ $item->id }}" >{{ App\Helpers\Admin::transPermission($item->name) }}
                                                </option>
                                               
                                            @endforeach
                                            
                                        </select>
                                        
                                    </div>

                                </div>

                                <div class="row mb-3 text-end">
                                    <div>
                                        <a href="{{ route('admin.roles.index') }}"
                                            class="btn btn-primary waves-effect waves-light ml-3 btn-sm">@lang('button.cancel')</a>

                                        <button type="submit"
                                            class="btn btn-outline-success waves-effect waves-light ml-3 btn-sm">@lang('button.save')</button>
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


@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/js/jquery.multi-select.min.js"></script>
    <script>
        $('.multi-select').multiSelect();
    </script>

    <script>
        $(document).ready(function() {

                    $('#cheakAll').on('click', function() {
                            if ($('#cheakAll').is(':checked')) {

                                // $('#permissions option').attr('','true');
                                $('#permissions option').each(function(){
                                    $(this).attr("selected", true);
                                         });
                                    $('.ms-selectable li').hide();
                                    $('.ms-selection  li').show();
                                }
                                else {
                                    $('.ms-selectable li').show();
                                    $('.ms-selection  li').hide();

                                }
                        
                            });

                    });
    </script>
@endsection
