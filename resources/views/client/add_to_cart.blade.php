@extends('client.app')


@section('content')
@if(session()->has('message'))
<div>{{session()->get('message')}}</div>
@endif

@if(\Jackiedo\Cart\Facades\Cart::getDetails()->total < 1) <h2 class="text-center">السلة فارغة</h2>
    @else

    <div class="Cart mt-5 mx-3 mx-lg-0">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8 ProductCart p-3 p-lg-5">

                    @forelse ($cart->items  as $key => $item)
                        @php
                            $product = App\Models\Product::find(@$item->id);
                        @endphp
                        @livewire('client.product-table', ['product' => $product , 'cart_item' => $item , 'districts' => $districts ,'mosques' => $mosques , 'cities' => $cities ] )
                    @empty
                        
                    @endforelse
                </div>


                <div class="col-12 col-lg-3 total p-3 me-lg-3 mt-3 mt-lg-0">
                    <h4>ملخص الطلب</h4>
                    <ul class="mt-3 p-0">
                        <li class="d-flex justify-content-between align-items-center">
                            <span>ملخص الطلب</span>
                            <span> @livewire('client.cart-counter') </span>
                        </li>
                        <li class="d-flex justify-content-between align-items-center">
                            <span> الاجمالي</span> <span class="totalMoney"> @livewire('client.cart-counter') </span>
                        </li>
                    </ul>
                    <a href="{{ route('client.checkout.index') }}" class="btn btn-confirm">إتمام الطلب</a>
                </div>
                

            </div>
        </div>


    </div>

    @endif



    @endsection
