<?php

namespace Anibalealvarezs\RestaurantMenu\Helpers;

use Anibalealvarezs\Projectbuilder\Helpers\AeasHelpers;

class RmHelpers extends AeasHelpers
{
    function __construct()
    {
        $this->vendor = 'Anibalealvarezs';
        $this->package = 'RestaurantMenu';
        $this->dir = 'restaurant-menu';
        $this->prefix = 'Rm';
        $this->name = 'restmenu';
    }
}
