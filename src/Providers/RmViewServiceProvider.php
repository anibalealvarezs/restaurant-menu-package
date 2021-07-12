<?php

namespace Anibalealvarezs\RestaurantMenu\Providers;

use Anibalealvarezs\Projectbuilder\Traits\PbServiceProviderTrait;
use Anibalealvarezs\RestaurantMenu\Helpers\RmHelpers;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;

class RmViewServiceProvider extends ServiceProvider
{
    use PbServiceProviderTrait;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Kernel $kernel)
    {
        $this->booter(RmHelpers::RM_NAME, RmHelpers::RM_PACKAGE, RmHelpers::RM_DIR);
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
