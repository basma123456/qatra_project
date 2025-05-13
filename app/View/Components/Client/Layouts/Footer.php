<?php

namespace App\View\Components\Client\Layouts;

use App\Models\Menue;
use App\Settings\SettingSingleton;
use Illuminate\View\Component;

class Footer extends Component
{

    public $menus, $settings;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->menus  = Menue::active()->footer()->get();
        $this->settings = SettingSingleton::getInstance();

    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.client.layouts.footer',  ['menuItems' => $this->menus]);
    }
}
