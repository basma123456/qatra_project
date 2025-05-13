<?php

namespace App\Http\Livewire\Client\Profile;

use App\Models\Order;
use App\Models\OrderStatus;
use Livewire\Component;

class Orders extends Component
{
    public  $pageCount = 10;
    public $selectedStatus = "";

    public $countOrders = 0, $totalOrders = 0;

    public $orderCarousels = [];
    public $ordersCount, $carouselIndex = 0;

    public $orderStatus;

    public function updateSelectStatus(){
        if($this->selectedStatus != ""){
            $query = Order::with(['payment_type', 'order_status'])->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->where('order_status_id', $this->selectedStatus);
        }
        else{
            $query = Order::with(['payment_type', 'order_status'])->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc');
        }
        $this->orderCarousels = [];
        $this->ordersCount = $query->count();
        $this->totalOrders =  (clone $query)->get()->Sum('total');
        $this->orderCarousels[$this->carouselIndex] = $query->offset($this->carouselIndex * $this->pageCount)->limit($this->pageCount)->get()->toArray();
    }

    
    public function loadOrders($carouselIndex = 0)
    {
        if($this->selectedStatus != ""){
            $query = Order::with(['payment_type', 'order_status'])->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->where('order_status_id', $this->selectedStatus);
        }
        else{
            $query = Order::with(['payment_type', 'order_status'])->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc');
        }

        $this->ordersCount = $query->count();
       $this->orderCarousels[$carouselIndex] = $query->offset($carouselIndex * $this->pageCount)->limit($this->pageCount)->get()->toArray();
    }

    public function showMore(){
        $this->loadOrders(count($this->orderCarousels));
    }

    public function mount(){
        $query = Order::with(['payment_type', 'order_status'])->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc');
        $this->totalOrders =  (clone $query)->get()->Sum('total');
        $this->ordersCount = $query->count();
        $this->orderCarousels[$this->carouselIndex] = $query->offset($this->carouselIndex * $this->pageCount)->limit($this->pageCount)->get()->toArray();
        $this->orderStatus = OrderStatus::get();
    }

    public function render()
    {
        return view('livewire.client.profile.orders');
    }
}
