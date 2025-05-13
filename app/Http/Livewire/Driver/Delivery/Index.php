<?php

namespace App\Http\Livewire\Driver\Delivery;

use App\Helpers\Sender;
use App\Models\DriverOrder;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderImage;
use App\Models\OrderMessage;
use App\Traits\FileHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads, FileHandler;

    public $item;

    public $img = [], $message = "", $status = 1;

    public $showModal = false;

    public function mount($item)
    {
        $this->item = $item;
    }

    
    public function submitForm()
    {
        if ($this->img != []) {
            foreach ($this->img as $key => $img) {
                if ($img) {
                    $img_uploaded = $this->saveFile($img, 'orderImages', $key);
                    OrderImage::create([
                        'user_id' => Auth::guard('driver')->user()->id,
                        'order_id' => $this->item->order_id,
                        'order_details_id' => $this->item->order_details_id,
                        'img' => $img_uploaded,
                    ]);
                }
            }
        }
        if ($this->message) {
            OrderMessage::create([
                'user_id' => Auth::guard('driver')->user()->id,
                'order_id' => $this->item->order_id,
                'order_details_id' => $this->item->order_details_id,
                'message' => $this->message,
            ]);
        } else {
            OrderMessage::create([
                'user_id' => Auth::guard('driver')->user()->id,
                'order_id' => $this->item->order_id,
                'order_details_id' => $this->item->order_details_id,
                'message' => "تم التوصيل",
            ]);
        }
        // update order Details ID
        if ($this->status == 1) {
            $orderDetails = OrderDetail::find($this->item->order_details_id);
            $orderDetails->order_status_id = 100;
            $orderDetails->delivered_at = now();
            $orderDetails->save();
           

            // update order delivery ID
            if (OrderDetail::where('order_id', $orderDetails->order->id)->where('order_status_id', 100)->count() == OrderDetail::where('order_id', $orderDetails->order->id)->count()) {
                $order = Order::find($this->item->order_id);
                $order->order_status_id = 100;
                $order->delivered_at = now();
                $order->save();
            }
            $sender = new Sender();
            $sender->processDetails($orderDetails->id, 401);
        }
        session()->flash('success', trans('message.admin.status_changed_sucessfully'));

        return redirect()->route('drivers.delivery.index');
    }

    public function render()
    {
        return view('livewire.driver.delivery.index');
    }
}
