<div wire:keydown.escape="keyUp()">
    <i class='bx bx-loader-alt bx-spin bx-sm text-secondary position-fixed top-25 start-50 text-white' wire:loading></i>
    {{-- <i class='bx bx-loader-alt bx-spin' ></i> --}}
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-info btn-sm py-1  text-white" data-bs-toggle="modal" wire:click="toggleModal()" data-bs-target="#order-details{{ $order_id}}">
        @lang('Show')
    </button>
    @if ($show_details)
    <div class="modal fade show" id="order-details{{ $order_id }}" tabindex="-1" role="dialog" aria-modal="true" style="display: block;">
        <div class="modal-dialog modal-xl pt-5" role="document">
            <div class="modal-content mt-5 shadow">
                <div class="modal-header">
                    <h5 class="modal-title py-1" id="modalTitleId">
                        @lang('Order')
                    </h5>
                    <button type="button" class="btn-close float-right" data-bs-dismiss="modal" aria-label="Close" wire:click="toggleModal()"></button>
                </div>

                <div class="modal-body">

                    @php
                    $Orderdetails = $order->details;
                    @endphp

                    <table id="" class="table table-sm table-striped ">
                        <tr>
                            <th>ID</th>
                            <td>{{ $order->id }}</td>
                        </tr>
                        <tr>
                            <th> @lang('amount') </th>
                            <td>{{ $order->amount }}</td>
                        </tr>
                        <tr>
                            <th> @lang('tax') </th>
                            <td>{{ $order->tax }}</td>
                        </tr>
                        <tr>
                            <th> @lang('Total') </th>
                            <td>{{ $order->total }}</td>
                        </tr>
                        <tr>
                            <th> @lang('Payment Method') </th>
                            <td>
                                @switch($order->payment_type_id)
                                @case(2)
                                <a href="{{ asset('storage/'. $order->transfer->transfer_img) }}" target="_blank" class="btn btn-primary btn-sm text-white py-0 p-">
                                    {{ @$order->payment_type->name }}
                                    <i class="icofont-download bx-xs text-white"></i>
                                </a>
                                <span class="btn btn-info btn-sm py-0">{{ @$order->transfer?->bank?->name }}</span>
                                @break

                                @case(1)
                                <a>
                                    {{ @$order->payment_type->name}}<i class="bx bx-credit-card bx-xs"></i>
                                </a>
                                @break
                                @case(3)
                                <a>
                                    {{ @$order->payment_type->name }}<i class="bx bx-credit-card bx-xs"></i>
                                </a>
                                @break
                                @default
                                {{ @$order->payment_type->name }}
                                @endswitch
                            </td>
                        </tr>
                        <tr>
                            <th> @lang('date') </th>
                            <td>{{date('H:i:s d-m-Y', strtotime($order->created_at)) }}</td>
                        </tr>
                        <tr>
                            <th> @lang('Order Status') </th>
                            <td>{{ @$order->order_status->name }}</td>
                        </tr>

                        <tr>
                            <th>@lang('date') </th>
                            <td> {{ date('H:i:s d-m-Y', strtotime($order->created_at)) }} </td>
                        </tr>
                        <tr>
                            <th>@lang('note') </th>
                            <td> {{ $order->note }} </td>
                        </tr>
                        <tr>
                            <th> تتبع الشحنة </th>
                            <td> 
                                <a href="{{ route('order.tracking', $order->id) }}" class="btn btn-sm btn-primary">
                                    عرض
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>  الفاتورة </th>
                            <td> 
                                <a href="{{ route('order.invoices', $order->id) }}" class="btn btn-sm bg-success text-white">
                                    عرض
                                </a>
                            </td>
                        </tr>

                    </table>


                    {{-- Product ----------------------------------------------------- --}}
                    <div class="row justify-content-center align-items-center ">
                        <div class="col h5">@lang('Details')</div>
                    </div>

                    <div class="table-responsive-lg table-responsive">
                        <table class="table table-striped table-hover table-bordered table-light align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th> @lang('ID') </th>
                                    <th> @lang('title') </th>
                                    <th> @lang('quantity') </th>
                                    <th> @lang('price') </th>
                                    <th> @lang('Total') </th>
                                    <th> @lang('city') </th>
                                    <th> @lang('district') </th>
                                    <th> @lang('mosque') </th>
                                    <th> @lang('gift sender') </th>
                                    <th> @lang('gift recipient name') </th>
                                    <th> @lang('gift recipient mobile') </th>
                                    <th> @lang('Deleivery') </th>
                                    <th> @lang('coupon') </th>
                                </tr>
                            </thead>
                            <tbody class="">
                                @forelse ( $Orderdetails as $details)
                                <tr class="">
                                    <td>{{ $details->id }}</td>

                                    <td>{{ $details->title }}</td>
                                    <td>{{ $details->quantity }}</td>
                                    <td>{{ $details->price }}</td>
                                    <td>{{ $details->price * $details->quantity }}</td>
                                    <td>{{ @$details->city->name }}</td>
                                    <td>{{ @$details->district->name }}</td>
                                    <td>{{ @$details->mosque->name }}</td>
                                    <td>{{ $details->gift_sender }}</td>
                                    <td>{{ $details->gift_recipient_name }}</td>
                                    <td>{{ $details->gift_recipient_mobile }}</td>
                                    <td>
                                        {{ $details->delivery_name  }}
                                        {{ $details->delivery_mobile  }}
                                    </td>
                                    <td>{{ $details->coupon == 1 ? "نعم" : "لا" }}</td>
                                </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" wire:click="toggleModal()">
                        @lang('Close')
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
