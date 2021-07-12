<?php

namespace Anibalealvarezs\RestaurantMenu\Controllers;

use Anibalealvarezs\Projectbuilder\Controllers\PbBuilderController;
use Anibalealvarezs\RestaurantMenu\Helpers\RmHelpers;
use App\Http\Requests;

class RmBuilderController extends PbBuilderController
{
    function __construct($crud_perms = false)
    {
        if (!$this->prefix) {
            $this->prefix = 'Rm';
        }
        if (!$this->helper) {
            $this->helper = RmHelpers::PB_VENDOR.'\\'.RmHelpers::RM_PACKAGE.'\\Helpers\\'.$this->prefix.'Helpers';
        }
        if (!$this->package) {
            $this->package = $this->helper::RM_PACKAGE;
        }

        parent::__construct($crud_perms);
    }
}
