<?php

namespace Anibalealvarezs\RestaurantMenu\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\View;

class RmComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(\Illuminate\Contracts\Http\Kernel $kernel)
    {
        // View Composers
        View::composers([
            'Anibalealvarezs\RestaurantMenu\ViewComposers\ScriptsComposer' => ['restmenu::layouts.front.resources.scripts'],
            'Anibalealvarezs\RestaurantMenu\ViewComposers\StylesComposer' => ['restmenu::layouts.front.resources.styles']
        ]);
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