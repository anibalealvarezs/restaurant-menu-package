<?php

namespace Anibalealvarezs\RestaurantMenu\Helpers;

use Anibalealvarezs\Projectbuilder\Helpers\Shares;
use Anibalealvarezs\RestaurantMenu\Models\RmMenu;
use Anibalealvarezs\RestaurantMenu\Models\RmMenuItem;
use Anibalealvarezs\RestaurantMenu\Models\RmMenuSection;

class RmShares extends Shares
{
    public static function list($elements, $parent = null): array
    {
        $list = parent::list($elements);
        foreach ($elements as $element) {
            switch ($element) {
                case "menus":
                    $list = array_merge($list, self::getMenus());
                    break;
                case "menusections":
                    $list = array_merge($list, self::getMenuSections($parent));
                    break;
                case "menuitems":
                    $list = array_merge($list, self::getMenuItems($parent));
                    break;
                default:
                    break;
            }
        }
        return $list;
    }

    public static function getMenus(): array
    {
        return [
            'menus' => RmMenu::all()
        ];
    }

    public static function getMenuSections($parent): array
    {
        if ($parent) {
            $menusections = RmMenuSection::where('menu_id', $parent)->get();
        } else {
            $menusections = RmMenuSection::all();
        }
        return [
            'menusections' => $menusections
        ];
    }

    public static function getMenuItems($parent): array
    {
        if ($parent) {
            $menuitems = RmMenuItem::where('menu_section_id', $parent)->get();
        } else {
            $menuitems = RmMenuItem::all();
        }
        return [
            'menuitems' => $menuitems
        ];
    }
}
