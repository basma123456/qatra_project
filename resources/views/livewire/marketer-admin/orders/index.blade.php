<div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between">
                                <div class="content-left">
                                    <span>الطلبات المضافة</span>
                                    <div class="d-flex align-items-end mt-2">
                                        <h4 class="mb-0 me-2">{{ ($statistics['all']) }}</h4>
                                    </div>
                                    <small>طلب</small>
                                </div>
                                <span class="badge bg-label-primary rounded p-2">
                                    <i class="bx bx-customize bx-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between">
                                <div class="content-left">
                                    <span>طلبات في انتظار تأكيد التحويل</span>
                                    <div class="d-flex align-items-end mt-2">
                                        <h4 class="mb-0 me-2">{{ ($statistics['transfer']) }}</h4>
                                    </div>
                                    <small>طلب</small>
                                </div>
                                <span class="badge bg-label-primary rounded p-2">
                                    <i class="bx bx-user bx-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between">
                                <div class="content-left">
                                    <span>طلبات في انتظار التنفيذ</span>
                                    <div class="d-flex align-items-end mt-2">
                                        <h4 class="mb-0 me-2">{{ ($statistics['waiting']) }}</h4>
                                    </div>
                                    <small>طلب</small>
                                </div>
                                <span class="badge bg-label-primary rounded p-2">
                                    <i class="bx bx-customize bx-sm"></i>
                                    {{-- <i class="menu-icon tf-icons bx bx-customize"></i> --}}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between">
                                <div class="content-left">
                                    <span>الطلبات المنفذة</span>
                                    <div class="d-flex align-items-end mt-2">
                                        <h4 class="mb-0 me-2">{{ ($statistics['finished']) }}</h4>
                                    </div>
                                    <small>طلب</small>
                                </div>
                                <span class="badge bg-label-primary rounded p-2">
                                    <i class="bx bx-user bx-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            {{-- Start Form search --}}
            <div class="card-body  search-group">
                <form wire:submit.prevent="filters">
                    <div class="row" wire:ignore>
                        <div class="col-md-2 mb-3">
                            <input type="text" value="{{ $search_identifier ?? '' }}" wire:model.lazy="search_identifier" placeholder="{{ trans('identifier') }}" class="form-control">
                        </div>
                        <div class="col-md-2 mb-3">
                            <input type="text" value="{{ $search_name ?? '' }}" wire:model.lazy="search_name" placeholder="@lang('name')" class="form-control">
                        </div>
                        <div class="col-md-2 ">
                            <input type="text" value="{{ $search_mobile ?? '' }}" wire:model.lazy="search_mobile" placeholder="@lang('mobile')" class="form-control">
                        </div>
                        <div class="col-md-2 mb-3">
                            <input type="text" value="{{ $search_email ?? '' }}" wire:model.lazy="search_email" placeholder="@lang('Email')" class="form-control">
                        </div>

                        <div class="col-md-2 ">
                            <select wire:model="search_payment_id" class="form-control">
                                <option value=""> @lang('Payment Method') </option>
                                @forelse ($paymentMethods ??[] as $payment)
                                    <option value="{{ $payment->id }}">
                                        {{ $payment->name }}
                                    </option>
                                @empty
                                @endforelse
                            </select>
                        </div>

                        <div class="col-md-2 ">
                            <select wire:model="search_status" class="form-control">
                                <option value=""> @lang('Order Status') </option>
                                @forelse ($orderStatus ??[] as $status)
                                    <option value="{{ $status->id }}">
                                        {{ $status->name }}
                                    </option>
                                @empty
                                @endforelse
                            </select>
                        </div>

                        <div class="col-md-2">
                            <input type="number" step="any" wire:model="search_price_from" placeholder="{{ trans('price_from') }}" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <input type="number" step="any" wire:model="search_price_to" placeholder="{{ trans('price_to') }}" class="form-control">
                        </div>

                        <div class="col-md-2">
                            <input type="date" wire:model="search_created_from" placeholder="{{ trans('created_from') }}" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <input type="date" wire:model="search_created_to" placeholder="{{ trans('created_to') }}" class="form-control">
                        </div>
                        <div class="text-end mt-2">
                            <span class="">
                                <button class="btn-info btn-sm btn text-white" type="submit">@lang('admin.search')</button>
                            </span>
                            <span class="">
                                <button class="btn-danger btn-sm btn text-white" wire:click="clearSearch">@lang('admin.delete')</button>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        {{-- end Form search --}}
    </div>
    @if ($message)
        <div class="alert alert-{{ $msg_type }} alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>{{ $message }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="main-datatable" class="table table-striped table-bordered " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr class="bluck-actions bulk-action-order" @if (empty($mySelected)) style="display: none" @endif scope="row">
                        <td colspan="16">
                            <div class="col-md-12 mt-0 mb-0 text-center">

                            </div>
                        </td>
                    </tr>
                    <tr class="text-center">
{{--                        <th style="width: 1px">--}}
{{--                            <input type="checkbox" id="check-all" wire:model="selectAll">--}}
{{--                        </th>--}}
                        <th>#</th>
                        <th> @lang('name') </th>
                        <th> @lang('mobile') </th>
                        <th> @lang('amount') </th>
                        <th> @lang('tax') </th>
                        <th> @lang('Total') </th>
                        <th> @lang('marketer') </th>
                        <th> @lang('Payment Method') </th>
                        <th> @lang('date') </th>
                        <th> @lang('Order Status') </th>
                        <th> @lang('Details') </th>
                        {{--                        <th>@lang('admin.actions') </th>--}}
                    </tr>

                    </thead>
                    <tbody>
                    @forelse ($items as $key => $item)
                        <tr class="text-center">
{{--                            <td>--}}
{{--                                <input type="checkbox" class="checkbox-check" wire:model.ignore="mySelected" value="{{ $item->id }}" {{ in_array($mySelected, [$item->id]) ? 'selected' : '' }}>--}}
{{--                            </td>--}}
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->user->mobile }}</td>
                            <td>{{ $item->amount }}</td>
                            <td>{{ $item->tax }}</td>
                            <td>{{ $item->total }}</td>
                            <td>{{ $item->marketer_id }}</td>
                            <td>
                                @switch($item->payment_type_id)
                                    @case(2)
                                    <a href="{{ asset('storage/'. @$item->transfer->transfer_img) }}" target="_blank" >
                                        {{ @$item->payment_type->name }}
                                    </a>
                                    @break
                                    @case(1)
                                    <a>
                                        {{ @$item->payment_type->name}}
                                    </a>
                                    @break
                                    @case(3)
                                    <a>
                                        {{ @$item->payment_type->name }}
                                    </a>
                                    @break
                                    @default
                                    {{ @$item->payment_type->name }}
                                @endswitch
                            </td>
                            <td>{{ date('H:i:s d-m-Y', strtotime($item->created_at)) }}</td>
                            <td>
                                @switch(@$item->order_status_id)
                                    @case('100')
                                    <p class="border border-success rounded text-center text-success mt-0"> {{ $item->order_status->name }} </p>
                                    @break
                                    @case('201')
                                    <p class="border border-secondary rounded text-center text-secondary mt-0"> {{ $item->order_status->name }} </p>
                                    @break
                                    @case('202')
                                    <p class="border border-info rounded text-center text-info mt-0"> {{ $item->order_status->name }} </p>
                                    @break
                                    @case('301')
                                    <p class="border border-primary rounded text-center text-primary mt-0"> {{ $item->order_status->name }} </p>
                                    @break
                                    @case('404')
                                    <p class="border border-danger rounded text-center text-danger mt-0"> {{ $item->order_status->name }} </p>
                                    @break
                                    @default

                                @endswitch
                            </td>

                            <td>
                                @livewire('marketer-admin.orders.show', ['order_id' => $item->id], key($item->id))
                            </td>
                            {{--                            <td>--}}
                            {{--                                <div class="d-flex justify-content-center bulk-order">--}}
                            {{--                                    <button type="button" data-hover="@lang('admin.delete')" class="btn btn-neutral text-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $item->id }}">--}}
                            {{--                                        <span class="mdi mdi-delete-outline fs-5"></span>--}}
                            {{--                                    </button>--}}
                            {{--                                    <div wire:ignore.self class="modal fade" id="delete{{ $item->id }}" tabindex="-1" aria-labelledby="delete{{ $item->id }}" aria-hidden="true">--}}
                            {{--                                        <div class="modal-dialog">--}}
                            {{--                                            <div class="modal-content">--}}
                            {{--                                                <div class="modal-body">--}}
                            {{--                                                    <h4 class="swal2-title py-3" id="swal2-title" style="display: flex;"> @lang('admin.are_you_sure')</h4>--}}
                            {{--                                                    <div class="modal-footer p-1">--}}
                            {{--                                                        <button type="button" class="btn btn-sm p-1 btn-secondary" data-bs-dismiss="modal">@lang('button.cancel')</button>--}}
                            {{--                                                        <button type="button" wire:click="delete({{$item->id}})" class="btn btn-sm p-1 btn-danger close-modal" data-bs-dismiss="modal">--}}
                            {{--                                                            @lang('button.delete')--}}
                            {{--                                                        </button>--}}
                            {{--                                                    </div>--}}
                            {{--                                                </div>--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}

                            {{--                                </div>--}}
                            {{--                            </td>--}}

                        </tr>
                    @empty
                        <tr>
                            <th colspan="12">
                                <div class="alert alert-danger d-flex align-items-center " role="alert">
                                    <div class="text-center">
                                        {{ trans('message.admin.no_date') }}
                                    </div>
                                </div>
                            </th>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="col-md-12 text-center mt-3">
                {{ $links->links('pagination::bootstrap-4') }}
            </div>

        </div>




    </div>
</div>
