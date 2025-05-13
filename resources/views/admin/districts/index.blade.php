@extends('admin.layout')

@section('name_ar', trans('admin.users' ))
@section('name_ar_page', trans('admin.users' ))

@section('title', trans('admin.districts_show'))
@section('title_page', trans('admin.districts'))
@section('title_route', route('admin.districts.index') )
@section('button_page')
<a href="{{ route('admin.districts.create') }}" class="btn btn-outline-success btn-sm">@lang('admin.create')</a>
@endsection



@section('content')

<div class="card">
    <div class="card-body  search-group">
        <div class="row">
            <div class="col-md-12 text-end mb-2">
                <a href="{{ route('admin.districts.create') }}" class="btn btn-outline-success btn-sm">اضف منطقة</a>
            </div>
        </div>

        <form action="{{route('admin.districts.index')}}" method="get">
            <div class="row">
                <div class="col-md-3 mb-2">
                    <input type="text" value="{{ request()->name != '' ? request()->name : ''}}" name="name" placeholder="{{ trans('admin.search_title') }}" class="form-control">
                </div>
                <div class="col-md-3 mb-2">
                    <select name="city_id" id=""  class="form-select select2">
                        <option value=""></option>
                        @forelse($cities as $key => $city)
                            <option value="{{ $city->id }}" {{ $city->id == request()->city_id ? 'selected':'' }}> {{ $city->name_ar }}  | {{ $city->name_en }} </option>
                        @empty
                            
                        @endforelse
                    </select>
                </div>
                <div class="search-input col-md-2">
                    <button class="btn btn-primary btn-sm" type="submit" data-hover="{{ trans('button.search') }}"> <i class="fas fa-search"></i> </button>
                    <a class="btn btn-success btn-sm" href="{{route('admin.districts.index')}}" data-hover="{{ trans('button.reset') }}"> <i class="fas fa-undo"></i> </a>
                </div>
            </div>
        </form>
    </div>
</div>



<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <form id="update-cities" action="{{route('admin.districts.actions')}}" method="post">
                @csrf
            </form>
            <div class="table-responsive">
                <table id="main-datatable" class="table table-bordered text-center table-striped table-table-success table-hover" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr class="bluck-actions" style="display: none" scope="row">
                            <td colspan="8">
                                <div class="col-md-12 mt-0 mb-0 text-center">
                                    <button form="update-cities" class="btn btn-success" type="submit" name="publish" value="1"> <i class="fas fa-check"></i> </button>
                                    <button form="update-cities" class="btn btn-warning" type="submit" name="unpublish" value="1"> <i class="fas fa-ban"></i> </button>
                                    <button form="update-cities" class="btn btn-danger" type="submit" name="delete_all" value="1"> <i class="fas fa-trash"></i> </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th style="width: 1px">
                                <input form="update-cities" class="checkbox-check flat" type="checkbox" name="check-all" id="check-all">
                            </th>
                            <th style="width: 2px">#</th>
                            <th>@lang('admin.name') Arabic</th>
                            <th>@lang('admin.name') English</th>
                            <th>@lang('admin.cities')</th>
                            <th>@lang('admin.actions')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $key => $item)
                        <tr>
                            <td>
                                <input form="update-cities" class="checkbox-check" type="checkbox" name="record[{{$item->id}}]" value={{ $item->id }}>
                            </td>
                            <th scope="row">{{$items->firstItem() + $key}}</th>
                            <td>
                                {{ $item->name_ar}}
                            </td>
                            <td>
                                {{ $item->name_en}}
                            </td>
                            <td>
                                {{ $item->city?->name}}
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    @if($item->status == 1)
                                    <a href="{{ route('admin.districts.update-status', $item->id) }}" class="btn btn-xs btn-outline-success btn-sm m-1" data-hover="{{ trans('button.active') }}"> <i class="fas fa-solid fa-check"></i> </a>
                                    @else
                                    <a href="{{ route('admin.districts.update-status', $item->id) }}" class="btn btn-xs btn-outline-warning btn-sm m-1" data-hover="{{ trans('button.unactive') }}"> <i class="fas fa-solid fa-ban"></i> </a>
                                    @endif

                                    <a href="{{ route('admin.districts.show', $item->id) }}" name="@lang('admin.show')" class="btn btn-xs btn-outline-info btn-sm m-1"><i class="fas fa-eye"></i></a>


                                    <a href="{{ route('admin.districts.edit',$item->id) }}" name="@lang('admin.edit')" class="btn btn-outline-primary btn-sm m-1"><i class="fas fa-pencil-alt"></i></a>

                                    <a class="btn btn-outline-danger btn-sm m-1" name="@lang('admin.delete')" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item->id }}">
                                        <i class="fas fa-trash-alt"> </i>
                                    </a>
                                
                                </div>
                            </td>
                        </tr>

                        @include('admin.layouts.delete', ['route'=> 'admin.districts.destroy'])

                        @empty

                        @endforelse

                    </tbody>
                </table>
            </div>

            <div class="col-md-12 text-center mt-3">
                {{ $items->links('pagination::bootstrap-4') }}
            </div>

        </div>
    </div>
</div>


@endsection
