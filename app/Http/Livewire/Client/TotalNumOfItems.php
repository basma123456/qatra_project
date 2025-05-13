<?php

namespace App\Http\Livewire\Client;

use Jackiedo\Cart\Facades\Cart;
use Livewire\Component;

class TotalNumOfItems extends Component
{
    protected $listeners = ['cart_updated' => 'render'];

    public function render()
    {
        $items_count =Cart::getDetails()->quantities_sum ;
        return view('livewire.client.total-num-of-items' , compact('items_count'));
    }
}
