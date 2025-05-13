<?php

namespace App\Http\Livewire\Client;

use Jackiedo\Cart\Facades\Cart;
use Livewire\Component;

class CartCounter extends Component
{

    protected $listeners = ['cart_updated' => 'render'];

    public function render()
    {
        $total =Cart::getDetails()->total;
        return view('livewire.client.cart-counter' , compact('total'));
    }
}
