<div>
    <div class="row mt-5">
        <div class="col-12 col-lg-8" wire:ignore>
            <div class="Path d-flex justify-content-center justify-content-lg-start">
                <h3 class="ms-3"><a> الرئيسية </a></h3>
                <h3><a> الدفع </a></h3>
            </div>
            <div class="card mt-3">
                <div class="card-body p-3">
                    <ul class="product-list px-0" wire:ignore>

                        @forelse (@$items as $key => $item)
                            @php
                                $product = App\Models\Product::find(@$item->id);
                                $district = App\Models\District::find(@$item->options['district_id']);
                                $mosque = App\Models\Mosque::find(@$item->options['mosque_id']);
                                if (!@$item->taxable) {
                                    $taxes += @$item->total_price;
                                }
                            @endphp

                            <li class="d-flex justify-content-lg-between flex-column flex-lg-row align-items-center flex-wrap">
                                <span class="img">
                                    <img src="{{ asset(is_array(json_decode(@$product->img, true)) ? asset('storage/' . json_decode(@$product->img, true)[0]) : asset('/attachments/no_images/no_image.png')) }}" class="img-fluid" alt="" />
                                    <p>{{ @$item->title }}</p>
                                </span>

                                <p class="name m-0 d-flex flex-column text-center">
                                    <span class="mb-3"> {{ @$district->name }} ( {{ @$mosque->name }} ) </span>
                                    <span>
                                        @if (@$item->options['sender_name'] != null)
                                            <i class="bx bx-gift fs-4 mx-2" class="btn" data-bs-toggle="modal" data-bs-target="#GiftData{{ $key }}"></i>
                                        @endif
                                        @if (@$item->options['delivery_name'] != null)
                                            <i class="bx bxs-user-detail fs-4 mx-2" data-bs-toggle="modal" data-bs-target="#delivery_{{ $key }}"></i>
                                        @endif
                                        @if (@$item->options['favoriteMosque'] == 1)
                                            <i class='bx bxs-heart fs-4 mx-2'></i>
                                        @endif
                                    </span>
                                </p>

                                @if (@$item->options['delivery_name'] != null)
                                    <!-- Modal -->
                                    <div class="modal fade" id="delivery_{{ $key }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel"> بيانات الاهداء </h1>
                                                    <button type="button" class="btn-close mx-0" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>اسم المستلم : {{ @$item->options['delivery_name'] }} </p>
                                                    <p>رقم الجوال المستلم : {{ @$item->options['delivery_mobile'] }} </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Modal -->
                                <div class="modal fade" id="GiftData{{ $key }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel"> بيانات الاهداء </h1>
                                                <button type="button" class="btn-close mx-0" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>اسم المهدي : {{ @$item->options['sender_name'] }} </p>
                                                <p>ااسم المهدى إليه : {{ @$item->options['recipient_name'] }} </p>
                                                <p>اسم المهدي : {{ @$item->options['recipient_mobile'] }} </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--Modal-->

                                <p class="sinlgeprice m-0">
                                    <small class="unit">الوحده</small>
                                    <small class="price"> {{ @$item->price }} ريال </small>
                                </p>

                                <p class="cart-number m-0">
                                    <small class="unit">الكمية </small>
                                    <small class="price">
                                        <span class="px-2">{{ @$item->quantity }}</span>
                                    </small>
                                </p>

                                <span class="price text-start">
                                    <span>{{ @$item->total_price }}</span>
                                    <small>ريال</small>
                                </span>
                            </li>
                        @empty
                        @endforelse

                    </ul>
                </div>
                {{-- <div class="card-total d-flex justify-content-between">
                    <span class="title">إجمالي</span>
                    <span class="price"> {{ @$items_subtotal }} <small>ريال</small></span>
                </div> --}}
            </div>
            <div class="TotalCard">
                <div class="card">
                    <div class="card-body p-3">
                        <ul class="product-list px-0">

                            <li class="deatiles d-flex justify-content-center align-items-center flex-row my-2">
                                {{-- favoriteMosque --}}
                                <div class=" promocode col-6">
                                    <p class="mb-0" role="button">أدخل كود الخصم</p>
                                    <div class="feild d-flex align-items-center">
                                        <input type="text" wire:model="coupon" />
                                        <button wire:click="addCoupon">تفعيل</button>
                                    </div>
                                    @if ($couponError)
                                        <div class="alert alert-danger alert-dismissible fade show my-0 py-2" role="alert">
                                            {{ $couponError }}
                                            <button type="button" class="btn-close btn-sm pt-1" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif
                                    @if ($couponMessage)
                                        <span class="badge bg-primary py-2">{{ $couponMessage }}</span>
                                    @endif
                                </div>
                                <div class="notes d-flex col-6">
                                    <h4 class="h6">الملاحظة</h4>
                                    <textarea wire:model.debounce="note" class="form-control" row="3"></textarea>
                                </div>

                            </li>

                            <label class=" toggle-switch">
                                <input type="checkbox" wire:model="favoriteMosque" @if ($favoriteMosque == 1) checked @endif />
                                أضافه كل المساجد الي المفضله ؟
                            </label>

                            <div class="row mt-5 border-bottom ">
                                <div class="col-md-6 col-12">
                                    <h4 class="h6">المجموع</h4>
                                </div>
                                <div class="col-md-6 col-12 text-start">
                                    <p>{{ @$items_subtotal }} <small>ريال</small></p>
                                </div>
                            </div>

                            <div class="row tax">
                                <div class="col-md-6 col-12">
                                    <h4 class="h6"> الضربية 15% </h4>
                                </div>
                                <div class="col-md-6 col-12 text-start" wire:ignore>
                                    <p>{{ $taxes * 0.15 }} <small>ريال</small></p>
                                </div>
                            </div>
                            </li>

                        </ul>
                    </div>
                    <div class="card-total d-flex justify-content-between" wire:ignore>
                        <span class="title">إجمالي</span>
                        <h5 class="price">{{ @$items_subtotal + $taxes * 0.15 }} <small>ريال</small></h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">

            @livewire('client.profile.auth.index')

            <div class="TotalCard">

                <div class="card mt-3">
                    @livewire('client.payments.index', ['taxes' => $taxes, 'note' => $note, 'cart' => $cart])
                </div>
            </div>
        </div>
    </div>
</div>
