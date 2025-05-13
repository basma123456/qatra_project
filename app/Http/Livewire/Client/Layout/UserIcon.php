<?php

namespace App\Http\Livewire\Client\Layout;

use Livewire\Component;

class UserIcon extends Component
{
    public $user = null;

    protected $listeners = ['authUpdated'];

    public function authUpdated(){
        $this->user = auth()->user();
    }

    public function render()
    {
        $this->user = auth()->user();
        return view('livewire.client.layout.user-icon');
    }
}
