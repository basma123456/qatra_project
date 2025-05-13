<?php

namespace App\Providers;

use App\Settings\SettingSingleton;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (Schema::hasTable('settings_values')) {
            $meta = SettingSingleton::getInstance()->getSiteSetting();
            $setting = SettingSingleton::getInstance()->getMetaSetting();
                $setting['logo'] = \Illuminate\Support\Facades\Storage::url(SettingSingleton::getInstance()->getItem('logo'));
                $setting['icon'] = \Illuminate\Support\Facades\Storage::url(SettingSingleton::getInstance()->getItem('icon'));
            view()->share('SiteSetting', $setting);
            view()->share('metaSetting', $meta);

        }
    }
}
