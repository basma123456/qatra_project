<?php

namespace App\Http\Livewire\Marketer\Orders;

use App\Models\Order;
use Livewire\Component;

class Show extends Component
{
    public $show_details = false;
    public $order_id;
    public $order;
    public $showGift = [];


    public function toggleModal()
    {
        $this->show_details = !$this->show_details;
        if ($this->show_details) {
            $this->order =  Order::where(['id'=> $this->order_id , 'marketer_id' => auth()->guard('marketer')->id()])->first();
        }
    }

    public function showGiftCart($id){
        $this->showGift[$id] =  @$this->showGift[$id] == 1 ? 0 : 1;
    }

    public function keyUp()
    {
        $this->show_details = false;
    }

    public function render()
    {
        return view('livewire.marketer.orders.show');
    }
}
