<?php

namespace App\Http\Livewire\Client\Payments;

use Jenssegers\Agent\Agent;
use Livewire\Component;

class Index extends Component
{
    public  $paymentMethod = "";

    protected $listeners = ['updateAuth'];

    public $taxes, $note, $cart;

    public function updateAuth()
    {
        if (@auth()->user() != null) {
            $this->render();
        }
    }

    public function SelectPayment($val)
    {
        $this->paymentMethod = $val;
    }

    public function mount($taxes, $note, $cart)
    {
        $this->taxes = $taxes;
        $this->note = $note;
        $this->cart = $cart;
    }

    public function render()
    {

        $agent = new Agent();
        $browser = $agent->browser();
        $platform = $agent->platform();
        $device = $agent->device();
        $iphone = false;
        $safari = false;
        if ($device == "iPhone") {
            $iphone = true;
        }
        if ($browser == "Safari") {
            $safari = true;
        }
        return view('livewire.client.payments.index', ['iphone' => $iphone, 'safari' => $safari, 'browser' => $browser, 'platform' => $platform]);
    }
}
