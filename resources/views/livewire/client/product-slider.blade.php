<div class="div">
    <div class="imgbox">
        <a href="{{$product->slug ? route('client.products.show', $product->slug ) : '#' }}">
            <div class="topbox d-flex align-items-center justify-content-center">
                <h1> {{ $product->name }} </h1>
            </div>
            <img src="{{$product->getFirstPhoto()}}" class="img-fluid" />
        </a>
    </div>
    <div class="text-layer text-center mt-3">
        <span class="ms-lg-5"> {{$product->price}} ر.س</span>
        <span class="rate">
            <i class="bx bxs-star text-warning"></i>
            5
        </span>
        <input type="hidden" wire:model="name_ar" value="{{$product->name}}">
        <input type="number" class="d-none" id="qty_{{$product->id}}" wire:model="qty" value="">
        <input type="number" class="d-none" id="priceQty_{{$product->id}}" step="any" wire:model="priceQty" value="">


        <div class="Btns d-flex">
            <button class="btn btn-add mt-3 mx-3" wire:click="addToCart()">
                <i class="bx bx-basket"></i>
                إضافة للسلة
            </button>
            <button class="btn test mt-3 mx-3" wire:click="checkout()">
                <i class="bx bx-cart-add"></i>
                اطلب الان
            </button>
        </div>
    </div>
</div>
