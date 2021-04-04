<?php

namespace Anibalealvarezs\RestaurantMenu\Providers;

use Anibalealvarezs\RestaurantMenu\Helpers\RmHelpers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\View;

class RmControllerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(\Illuminate\Contracts\Http\Kernel $kernel)
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $aeas = new RmHelpers();
        $this->app->make($aeas->vendor.'\\'.$aeas->package.'\Controllers\Menu\\'.$aeas->prefix.'MenuController');
        $this->app->make($aeas->vendor.'\\'.$aeas->package.'\Controllers\Menu\\'.$aeas->prefix.'MenuItemController');
    }
}
