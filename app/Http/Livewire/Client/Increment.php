<?php

namespace App\Http\Livewire\Client;

use Livewire\Component;

class Increment extends Component
{



    public $qty;


    public function mount($qty)
    {
        $this->qty = $qty ?? 0;
    }





    public function render()
    {
        return view('livewire.client.increment');
    }

    public function addToCart()
    {
        $this->qty++;
    }

    public function minusFromCart()
    {
        $this->qty--;

        if ($this->qty < 0) {
            $this->qty = 0;
        }

    }







//$this->qty = $this->cart_item->quantity ?? 0;

}
