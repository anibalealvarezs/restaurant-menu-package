<?php

namespace Anibalealvarezs\RestaurantMenu\Controllers;

use Anibalealvarezs\Projectbuilder\Models\PbConfig;
use Anibalealvarezs\RestaurantMenu\Helpers\RmHelpers;
use Anibalealvarezs\RestaurantMenu\Models\RmMenu;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Inertia\Inertia;

class RmFrontController extends Controller
{
    /**
     * @var string
     */
    private $viewsPath;

    private $comission;

    private $vat;

    private $rate;

    function __construct()
    {
        $this->viewsPath = RmHelpers::RM_PACKAGE . '/Front/';
        $this->rate = PbConfig::findByKey('_MENU_EXCHANGE_RATE_')->configvalue;
        $this->comission = PbConfig::findByKey('_MENU_COMMISSION_')->configvalue;
        $this->vat = PbConfig::findByKey('_MENU_VAT_')->configvalue;
    }

    /**
     * Display a listing of the resource.
     *
     * @param null $id
     * @return void
     */
    public function index($id = null)
    {
        $query = RmMenu::with('menusections');
        if ($id) {
            $menu = $query->find($id);
        } else {
            $menu = $query->first();
        }

        foreach($menu->menusections as &$section) {
            foreach($section->menuitems as &$item) {
                $item->price_gross = $item->price * $this->rate;
                $item->tax = $item->price_gross * $this->vat / 100;
                $item->commission = $item->price_gross * $this->comission / 100;
                $item->price_total_ex = $item->price_gross + $item->tax + $item->commission;
                $item->price_total = $item->price_total_ex / $this->rate;

                // Formats
                $item->price_gross = number_format($item->price_gross, 0, ",", ".");
                $item->price_total = round($item->price_total);
                $item->price_total_ex = number_format($item->price_total_ex, 0, ",", ".");
                $item->commission = number_format($item->commission, 0, ",", ".");
                $item->tax = number_format($item->tax, 0, ",", ".");
            }
        }

        Inertia::setRootView(RmHelpers::RM_PACKAGE.'::app');
        return Inertia::render($this->viewsPath . 'Index', ['menu' => $menu]);
    }
}
