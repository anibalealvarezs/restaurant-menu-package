<?php

namespace Anibalealvarezs\RestaurantMenu\Providers;

use Anibalealvarezs\RestaurantMenu\Helpers\RmHelpers;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;

class RmControllerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Kernel $kernel)
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
        $this->app->make(RmHelpers::PB_VENDOR.'\\'.RmHelpers::RM_PACKAGE.'\Controllers\Menu\\'.RmHelpers::RM_PREFIX.'MenuController');
        $this->app->make(RmHelpers::PB_VENDOR.'\\'.RmHelpers::RM_PACKAGE.'\Controllers\Menu\\'.RmHelpers::RM_PREFIX.'MenuItemController');
        $this->app->make(RmHelpers::PB_VENDOR.'\\'.RmHelpers::RM_PACKAGE.'\Controllers\Menu\\'.RmHelpers::RM_PREFIX.'MenuSectionController');
    }
}
