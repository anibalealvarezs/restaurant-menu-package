<?php

namespace Anibalealvarezs\RestaurantMenu\Providers;

use Anibalealvarezs\RestaurantMenu\Helpers\RmHelpers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\View;

class RmViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(\Illuminate\Contracts\Http\Kernel $kernel)
    {
        $aeas = new RmHelpers();
        // Views
        $views = __DIR__ . '/../../resources/js';
        $this->loadViewsFrom($views, $aeas->prefix);
        $this->publishes([
            __DIR__ . '/../../resources/js' => resource_path('assets/'.$aeas->dir.'/js'),
        ], $aeas->name.'-components');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
