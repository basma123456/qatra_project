<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <button  wire:click="addToCart()" class="btn btn-increamet">+</button>

    <input type="number" wire:model="qty"  step="any"
           style="width: 4rem; height: 2.35rem; text-align: center; background-color:transparent; border:none; border-top:1px solid;  border-bottom:1px solid;"

    >
    <button wire:click="minusFromCart()" class="btn btn-decreamet">-</button>

</div>
