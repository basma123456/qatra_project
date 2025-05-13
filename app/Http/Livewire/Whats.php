<?php

namespace App\Http\Livewire;

use App\Helpers\Whats as WhatsCompnent;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Whats extends Component
{
    private $instance;
    function __construct()
    {
        $this->instance = new WhatsCompnent();
    }
    public function render()
    {
        $instance = $this->instance;
        return view('livewire.whats',compact("instance"));
    }

    function logout(){
        Log::info("Logout Click");
        $this->instance->logout();
    }

    function restart(){
        Log::info("Restart Click");
        $this->instance->logout();
    }
}
