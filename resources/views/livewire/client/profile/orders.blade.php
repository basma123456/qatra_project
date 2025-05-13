<div class="col-12 order-2 col-lg-9 mx-auto">
    <div class="info row px-lg-5 bg-white m-md-5">
        <h1 class="col-12 fs-2 text-center mt-5"> الطلبات</h1>


        <div class="numbers row py-2" dir="rtl">
            <div class="numerOfdonamtion col-md-5 col-12 me-1 bg-main rounded-3 text-center">
                <h1 class="fs-1 mt-3"> {{ $ordersCount }} </h1>
                <p class="fs-4" dir="rtl"> @lang('Number of donates') </p>
            </div>

            <div class="col-1">
                <!--extra div-->
            </div>

            <div class="totalAmount col-md-5 col-12 mt-3 mt-md-0 bg-main rounded-3 text-center">
                <h1 class="fs-1 mt-3"> {{ $totalOrders }} </h1>
                <p class="fs-4" dir="rtl"> @lang('Total Amount') </p>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="row text-center mt-3 filter-container">
            {{-- <div class="col-md-2 col-sm-4 mb-2">
                <input type="text" id="filterLocation" class="filter-input" placeholder="موقع المسجد" />
            </div>
            <div class="col-md-2 col-sm-4 mb-2">
                <input type="text" id="filterName" class="filter-input" placeholder="اسم المسجد" />
            </div>
            <div class="col-md-2 col-sm-4 mb-2">
                <input type="text" id="filterRegion" class="filter-input" placeholder="المنطقة" />
            </div>
            <div class="col-md-2 col-sm-4 mb-2">
                <input type="text" id="filterProject" class="filter-input" placeholder="المشروع" />
            </div>

            <div class="col-md-2 col-sm-4 mb-2">
                <input type="text" id="filterDate" class="filter-input" placeholder="تاريخ التبرع" />
            </div> --}}

            <div class="col-md-3 text-center col-12">
                <div class="dropdown mx-auto">
                    <select class="form-control" wire:model="selectedStatus" wire:change="updateSelectStatus">
                        <option value="">@lang('All')</option>
                        @forelse($orderStatus  as $key => $status)
                            <option value="{{ $status->id }}" {{ $selectedStatus == $status->id ? 'selected' : '' }}> {{ $status->name }} </option>
                        @empty
                            
                        @endforelse
                    </select>
                </div>
            </div>

            <div class="col-md-3 text-center col-12">
                <button class="btn-search">
                    بحث
                </button>
            </div>
        </div>
        <!--table section -->
        <div class="col-12 Table_section">
            <!--Table itSelf-->
            <div class="table-responsive row text-center mt-3">
                <table class="table text-center align-content-center table-striped table-bordered">
                    <thead>
                        <tr class="align-content-center">
                            <th> @lang('Identifier') </th>
                            <th> @lang('amount') </th>
                            <th> @lang('tax') </th>
                            <th> @lang('Total') </th>
                            <th> @lang('Payment Method') </th>
                            <th> @lang('date') </th>
                            <th> @lang('Order Status') </th>
                            <th> @lang('Details') </th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($orderCarousels as $key => $carousel)
                        @forelse ($carousel as $key => $order)
                        <tr>
                            <th scope="row">{{ $order['id'] }}</th>
                            <td>{{ $order['amount'] }}</td>
                            <td>{{ $order['tax'] }}</td>
                            <td>{{ $order['total'] }}</td>
                            <td>{{ $order['payment_type']['name_ar'] }}</td>
                            <td>{{ date('H:i:s d-m-Y', strtotime($order['created_at'])) }} </td>
                            <td>{{ $order['order_status']['name'] }}</td>
                            <td>
                                @livewire('client.profile.order-item', ['order_id' => $order['id']], key( $order['id']))
                            </td>
                        </tr>
                        @empty
                        @endforelse
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!--Table itSelf-->
        </div>

        <!--table section -->
    </div>
    @if ($ordersCount - (count($orderCarousels) * $pageCount) > 0)
    <div class="text-center my-2">
        <button wire:click="showMore" class="btn btn-primary btn-sm mb-3">
            @lang('More')
        </button>
    </div>
    @endif
</div>
