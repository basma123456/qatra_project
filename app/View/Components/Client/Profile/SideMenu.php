<?php

namespace App\View\Components\Client\Profile;

use Illuminate\View\Component;
// use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SideMenu extends Component
{
    public $locals = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $languages = collect(LaravelLocalization::getSupportedLocales() );
        // $current = LaravelLocalization::getCurrentLocale();
        // $locals = (clone $languages)->forget($current)->keys()->toArray();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.client.profile.side-menu');
    }
}
