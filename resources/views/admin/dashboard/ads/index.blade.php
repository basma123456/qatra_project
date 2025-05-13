@extends('admin.layout')

@section('title', "بنرات")
@section('title_ad',  "بنرات")

@section('style')
    {{-- @vite(['resources/assets/admin/css/data-tables.js']) --}}

@endsection

@section('content')

    <div class="container-fluid">


        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body  search-group">
                        <div class="row">
                            <div class="col-md-12 text-end mb-2">
                                <a href="{{ route('admin.ads.create') }}" class="btn btn-outline-success btn-sm">اضف
                                    بانر</a>
                            </div>
                        </div>
                        <form action="{{route('admin.ads.index')}}" method="get">
                            <div class="row">
                                <div class="col-md-3 mb-2">
                                    <input type="test" value="{{ request()->title != '' ? request()->title : ''}}"
                                           name="title" placeholder="بحث بالعنوان" class="form-control">
                                </div>
                                <div class="search-input col-md-2">
                                    <button class="btn btn-primary btn-sm" type="submit" title="بحث"><i
                                            class="fas fa-search"> </i></button>
                                    <a class="btn btn-warning btn-sm" href="{{route('admin.ads.index')}}"
                                       title="اعادة الضبط"><i class="refresh ion ion-md-refresh"></i></a>
                                </div>
                            </div>
                        </form>
                    </div>


                    <div class="card-body mt-0 pt-0">
                        <form id="update-ads" action="{{route('admin.ads.actions')}}" method="post">
                            @csrf
                        </form>
                        <table id="main-datatable"
                               class="table table-bordered text-center dt-responsive nowrap table-striped table-table-success table-hover table-sm"
                               style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                            <thead>

                            <tr class="bluck-actions" style="display: none" scope="row">
                                <td colspan="8">
                                    <div class="col-md-12 mt-0 mb-0 text-center">
                                        <button form="update-ads" class="btn btn-success btn-sm" type="submit"
                                                name="publish" value="1" title="{{ trans('button.active') }}"><i
                                                class="fa fa-check"></i></button>
                                        <button form="update-ads" class="btn btn-warning btn-sm" type="submit"
                                                name="unpublish" value="1" title="{{ trans('button.unactive') }}"><i
                                                class="fa fa-ban"></i></button>
                                        <button form="update-ads" class="btn btn-danger btn-sm" type="submit"
                                                name="delete_all" value="1" title="{{ trans('button.delete_all') }}"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <th style="width: 1px">
                                    <input form="update-ads" class="checkbox-check flat" type="checkbox"
                                           name="check-all" id="check-all">
                                </th>
                                <th style="width: 2px">#</th>
                                <th>العنوان</th>
                                <th>المحتوي</th>
                                <th>الصورة</th>
                                <th> اللوجو</th>


                                <th>اجرائات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($items as $key => $item)
                                <tr>
                                    <td>
                                        <input form="update-ads" class="checkbox-check" type="checkbox"
                                               name="record[{{$item->id}}]" value={{ $item->id }}>
                                    </td>

                                    <th scope="row">{{1 +$key}}</th>
                                    <td>
                                        {{-- @foreach($languages as $key=> $local)
                                            @if($key != 0)<br> @endif

                                        @endforeach --}}
                                        {{ $item->title}}

                                    </td>

                                    <td>
                                        {{  substr(\App\Helpers\removeHTML( @$item->content),0,30) }}
                                    </td>
                                    <td>
                                        <a href="{{asset($item->path() . $item->image)}}" target="_blank"> <img
                                                src="{{asset($item->pathInView())}}" alt="" style="width: 50px"></a>
                                    </td>
                                    <td>
                                        <a href="{{asset($item->pathLogo() .$item->logo)}}" target="_blank"> <img
                                                src="{{asset($item->getLogo())}}" alt="" style="width: 50px"></a>
                                    </td>



                                    <td>

                                        <div class="d-flex justify-content-center">
                                            @if($item->status == 1)
                                                <a href="{{ route('admin.ads.update-status', $item->id) }}"
                                                   class="btn btn-xs btn-success btn-sm m-1"
                                                   title="{{ trans('button.active') }}"><i class="fa fa-check"></i></a>
                                            @else
                                                <a href="{{ route('admin.ads.update-status', $item->id) }}"
                                                   class="btn btn-xs btn-outline-secondary btn-sm m-1"
                                                   title="{{ trans('button.unactive') }}"><i class="fa fa-ban"></i></a>
                                            @endif

                                            @if($item->feature == 1)
                                                <a href="{{ route('admin.ads.update-feature', $item->id) }}"
                                                   class="btn btn-xs btn-warning btn-sm m-1"
                                                   title="{{ trans('button.active') }}"><i class="fa fa-star"></i></a>
                                            @else
                                                <a href="{{ route('admin.ads.update-feature', $item->id) }}"
                                                   class="btn btn-xs btn-outline-warning btn-sm m-1"
                                                   title="{{ trans('button.unactive') }}"><i class="fa fa-ban"></i></a>
                                            @endif


                                            <a href="{{ route('admin.ads.show', $item->id) }}"
                                               class="btn btn-xs btn-outline-info btn-sm m-1"
                                               title="{{ trans('button.show') }}"><i class="fas fa-eye"></i></a>

                                            <a href="{{ route('admin.ads.edit', $item->id) }}"
                                               class="btn btn-outline-primary btn-sm m-1"
                                               title="{{ trans('button.edit') }}"><i class="fas fa-pencil-alt"></i></a>

                                            <a class="btn btn-outline-danger btn-sm m-1" data-bs-toggle="modal"
                                               data-bs-target="#exampleModal{{ $item->id }}"
                                               title="{{ trans('button.delete') }}">
                                                <i class="fas fa-trash-alt"> </i>
                                            </a>

                                        </div>


                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">الالغاء</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{-- <div class="swal2-icon-content text-warning h1">!</div> --}}
                                                        <h2 class="swal2-title" id="swal2-title" style="display: flex;">
                                                            هل انت متاكد من الالغاء ؟</h2>
                                                        <div class="modal-footer">
                                                            <form action="{{ route('admin.ads.destroy' , $item->id) }}"
                                                                  method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="btn btn-primary"
                                                                        data-dismiss="modal">لا
                                                                </button>
                                                                <button type="submit" class="btn btn-danger">نعم
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                    </td>
                                </tr>
                            @empty

                            @endforelse

                            </tbody>


                        </table>

                        <div class="col-md-12 text-center">
                            {{ $items->links() }}
                        </div>

                        </form>
                    </div>

                </div>

            </div>

        </div> <!-- container-fluid -->

@endsection


@section('script')

    {{-- @vite(['resources/assets/admin/js/data-tables.js']) --}}
@endsection
