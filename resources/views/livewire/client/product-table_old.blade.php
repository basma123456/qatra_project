{{--    <!--Product details-->--}}
{{--    <div class="Product">--}}
{{--        <div class="container">--}}
{{--            <h5>قال النبي</h5>--}}
{{--            <div class="row mt-3">--}}
{{--                <div class="col-12 col-lg-5">--}}
{{--                    <div class="imgbox">--}}
{{--                        <div class="topbox d-flex align-items-center justify-content-center">--}}
{{--                            <h1 class="h2">       {{$product->name_ar}} </h1>--}}
{{--                        </div>--}}
{{--                        <img src="{{asset($product->pathInView())}}" class="img-fluid"/>--}}
{{--                    </div>--}}
{{--                    <div class="input-group-1 mt-3 mb-3">--}}
{{--                        <select class="form-select" id="inputGroupSelect02">--}}
{{--                            <option selected>حدد المنطقة</option>--}}
{{--                            <option value="1">One</option>--}}
{{--                            <option value="2">Two</option>--}}
{{--                            <option value="3">Three</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                    <div class="input-group-2 mb-3">--}}
{{--                        <select class="form-select" id="inputGroupSelect02">--}}
{{--                            <option selected>حدد المسجد</option>--}}
{{--                            <option value="1">One</option>--}}
{{--                            <option value="2">Two</option>--}}
{{--                            <option value="3">Three</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="leftSide col-12 col-lg-7 p-3">--}}
{{--                    <h2 class="h3">تفاصيل المنتج:</h2>--}}
{{--                    <p>--}}
{{--                        {{$product->discription_ar}}--}}
{{--                    </p>--}}

{{--                    <div class="info d-flex align-items-center mt-5">--}}
{{--                        <div class="qunatity">--}}
{{--                            <h5>الكمية</h5>--}}
{{--                            <form wire:submit.prevent="addToCart({{$product->id}})" action="{{route('client.cart.store')}}" class="btns d-flex align-items-center"--}}
{{--                                  method="post">--}}
{{--                                @csrf--}}


{{--                                /**************/--}}
{{--                                <div class="btn btn-increamet btn" wire:click="$set('qty', {{$qty + 1}})">+</div>--}}
{{--                                <input type="number" wire:model="qty" value="1" class="text-sm sm:text-base leading-5">--}}
{{--                                <div class="btn btn-decreamet btn"  wire:click="$set('qty', {{$qty - 1}})">-</div>--}}


{{--                                /*************/--}}

{{--                                <div  class="btn btn-increamet">+</div>--}}

{{--                                <input type="hidden" wire:model="name_ar" value="{{$product->name_ar}}">--}}
{{--                                <input type="number" wire:model="qty.{{$product->id}}" value="1"--}}
{{--                                       class="text-sm sm:text-base leading-5">--}}
{{--                                <input type="number" step="any" value="{{$product->price}}" wire:model="price">--}}

{{--                                <div  class="btn btn-decreamet">-</div>--}}
{{--                            </form>--}}
{{--                            <div class="text-warning mt-3">--}}
{{--                                <i class="bx bxs-star"></i>--}}
{{--                                <i class="bx bxs-star"></i>--}}
{{--                                <i class="bx bxs-star"></i>--}}
{{--                                <i class="bx bxs-star"></i>--}}
{{--                                <i class="bx bxs-star"></i>--}}
{{--                                <i class="bx bx-share-alt shareicon"></i>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="price">--}}
{{--                            <h5>السعر</h5>--}}

{{--                            <h4> {{ $cart->price}}   qty: {{$qty}}</h4>--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <button class="btn btn-buy ">إتمام عملية الشراء</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!--Product details-->--}}


{{--/******here*********/--}}
@foreach($products as $product)
    @foreach($cart as $key => $val)
        @if($val->id === $product->id)

            <div class="row">
            <!--Product details-->
            <div class="">
                <div class="">
                    <h5>قال النبي</h5>
                    <div class="row mt-3">
                        <div class="col-12 col-lg-5">
                            <div class="imgbox">
                                <div class="topbox  align-items-center justify-content-center">
                                    <h1 class="h2">       {{$product->name_ar}} </h1>
                                </div>
                                <img src="{{asset($product->pathInView())}}" class="img-fluid"/>
                            </div>
                            <div class="input-group-1 mt-3 mb-3">
                                <select class="form-select" id="inputGroupSelect02">
                                    <option selected>حدد المنطقة</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="input-group-2 mb-3">
                                <select class="form-select" id="inputGroupSelect02">
                                    <option selected>حدد المسجد</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>

                        <div class="leftSide col-12 col-lg-7 p-3">
                            <h2 class="h3">تفاصيل المنتج:</h2>
                            <p>
                                {{$product->discription_ar}}
                            </p>

                            <div class="info  align-items-center mt-5">
                                <div class="qunatity">
                                    <h5>الكمية</h5>
                                    <div
                                           class="btns d-flex align-items-center"
                                          >




                                        {{--                                /**************/--}}
                                        <div class="btn btn-increamet btn" >+
                                        </div>
                                        <input  id="qty_{{$product->id}}"  type="number" step="any" wire:model="qty.{{$product->id}}" value="{{$val->quantity}}"
                                               class="text-sm sm:text-base leading-5">



                                        {{--                                /*************/--}}

                                        {{--                                <div  class="btn btn-increamet">+</div>--}}

                                        <input type="hidden" wire:model="name_ar" value="{{$product->name_ar}}">
                                                                        <input id="priceQty_{{$product->id}}" step="any"  type="number" wire:model="priceQty.{{$product->id}}" value="{{$val->quantity * $product->price}}"
                                                                               class="text-sm sm:text-base leading-5 bg-primary">
                                        {{--                                <input type="number" step="any" value="{{$product->price}}" wire:model="price">--}}

                                        {{--                                <div  class="btn btn-decreamet">-</div>--}}
{{--                                        <button   wire:click="minusFromCart({{$val}} , {{$product->id}})" class="btn btn-decreamet btn bg-success" >---}}
                                        <button   wire:click="minusFromCart({{$val}} ,  {{$product->id}})"  class="btn btn-decreamet btn bg-success" >-

                                        </button>


                                        <button  wire:click="addToCart({{$val}} ,  {{$product->id}})"  class="btn btn-increment">+</button>

                                    </div>
                                    <div class="text-warning mt-3">
                                        <i class="bx bxs-star"></i>
                                        <i class="bx bxs-star"></i>
                                        <i class="bx bxs-star"></i>
                                        <i class="bx bxs-star"></i>
                                        <i class="bx bxs-star"></i>
                                        <i class="bx bx-share-alt shareicon"></i>
                                    </div>
                                </div>
                                <div class="price">
                                    <h5>السعر</h5>

                                    <h4 >  {{ $product->price}}  </h4>

                                </div>
                            </div>
                            <button  class="btn btn-buy ">إتمام عملية الشراء</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--Product details-->
            </div>
        @endif
    @endforeach
@endforeach

<script>
    // function decreaseFunc(id) {
    //     let qty = document.getElementById('qty_' + id).value;
    //     // qty.value =  +(qty.value);
    //     qty.value -= parseFloat(1);
    //
    //     let priceQty = document.getElementById('priceQty_' + id);
    //     priceQty.value = parseFloat(priceQty.value) > 0 ? priceQty.value : parseFloat(document.getElementById('price_' + id).value);
    //     priceQty.value -= parseFloat(document.getElementById('price_' + id).value);
    //
    // }
    //
    // function increaseFunc(id) {
    //     let qty = document.getElementById('qty_' + id);
    //     // qty.value =  +(qty.value);
    //     console.log( parseFloat(qty.value));
    //     qty.value += parseFloat(1);
    //
    //     let priceQty = document.getElementById('priceQty_' + id);
    //     priceQty.value = parseFloat(priceQty.value) > 0 ? priceQty.value : parseFloat(document.getElementById('price_' + id).value);
    //     console.log( parseFloat(priceQty.value));
    //
    //     priceQty.value += parseFloat(document.getElementById('price_' + id).value);
    // }
</script>
