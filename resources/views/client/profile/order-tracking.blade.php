@extends('client.app')


@section('content')

<!--FollowOrder-->
<div class="FollowOrder">
    <div class="container">
        <div class="title text-center my-5">
            <h1>تتبع الطلب</h1>
        </div>
        <div class="details border-3 border rounded-3 my-3 p-3">
            <div class="order_number my-4">
                <h5>
                    <span>رقم العملية : </span>
                    <span> #{{ $order->id }}</span>
                </h5>
            </div>
            <div class="productImg my-4">
                <h5>
                    <span> المنتجات : </span>
                </h5>
                <div class="ImgBoxs row flex-wrap">
                    @forelse($order->details as $key => $detail)
                    <div class="col-md-3 col-12">
                        <figure class="text-center">
                            <img src="{{ asset(@$detail->product?->getFirstPhoto()) }}" alt="Trulli" style="width: 100px" />
                            <figcaption> {{ $detail->title }} </figcaption>
                        </figure>
                    </div>
                    @empty

                    @endforelse

                </div>
            </div>
            <div class="status my-4 p-4 rounded">
                <h6>بيانات الطلب</h6>
                <div class="row my-3">
                    <div class="col-12 col-lg-4">
                        <div class="name">
                            <h5>
                                <span>اسم المتبرع :</span>
                                <span>{{ @$order->user?->name }}</span>
                            </h5>
                        </div>
                        <div class="payment_method">
                            <h5>
                                <span>طريقه الدفع :</span>
                                @switch($order->payment_type_id)
                                @case(2)
                                <a href="{{ asset('storage/'. $order->transfer->transfer_img) }}" target="_blank" class="btn btn-primary btn-sm text-white py-0 p-">
                                    {{ @$order->payment_type->name }}
                                    <i class="icofont-download bx-xs text-white"></i>
                                </a>
                                <span class="btn btn-info btn-sm py-0">{{ @$order->transfer?->bank?->name }}
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
                            </h5>
                        </div>
                        <div class="price">
                            <h5>
                                <span>السعر:</span>
                                <span>{{ $order->total }}</span>
                            </h5>
                        </div>
                        <div class="date">
                            <h5>
                                <span>التاريخ:</span>
                                <span>{{date('H:i:s d-m-Y', strtotime($order->created_at)) }}</span>
                            </h5>
                        </div>
                    </div>
                    <div class="col-12 col-lg-8 text-center">
                        <h3 class="mt-3">
                            <span>حاله الطلب :</span>
                            <span>{{ @$order->order_status->name }} </span>
                        </h3>
                        <div class="row">
                            @forelse ($order->images as $image)
                                @if ($image->approved_at != null)
                                    <div class="col-md-3 col-12 mb-2">
                                        <a href="{{ url('storage/' . $image->img) }}" target="_blank">
                                            <img src="{{ url('storage/' . $image->img) }}" class="rounded border p-1 w-100"/>
                                        </a>
                                    </div>
                                @endif
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--FollowOrder-->


@endsection
