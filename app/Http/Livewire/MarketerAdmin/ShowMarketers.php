<?php

namespace App\Http\Livewire\MarketerAdmin;

use App\Models\Marketer;
use App\Models\MarketerAdmin;
use Livewire\Component;

class ShowMarketers extends Component
{


    public $marketers = [];
    public $marketer_admin;
    public $closeOrOpen = 'd-none';

    public function mount($marketer_admin)
    {
        $this->marketer_admin = $marketer_admin;
    }


    public function ShowMarketers($marketer_admin_id)
    {
        $this->marketers = Marketer::where('marketer_admin_id', $marketer_admin_id)->latest()->get();
        if($this->closeOrOpen == 'd-none'){
            $this->closeOrOpen = '';
        }else{
            $this->closeOrOpen = 'd-none';
        }
    }

    public function render()
    {
        return view('livewire.marketer-admin.show-marketers');
    }
}
