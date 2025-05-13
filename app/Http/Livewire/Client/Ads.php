<?php

namespace App\Http\Livewire\Client;

use Livewire\Component;

class Ads extends Component
{

    public $ads;
    public $skipVar = 2;

    public function mount()
    {

    }


    public function render()
    {
        return view('livewire/client/ads');
    }

    public function addTwoMore()
    {
        $items = \App\Models\Ads::active()->feature()->skip($this->skipVar)->take(2)->get();
        if (!count($items)) {
            toastr()->info('لا يوجد المزيد من الاعلانات');
        } else {
            $this->ads = $items;
            $this->skipVar += 2;
        }
    }


}
