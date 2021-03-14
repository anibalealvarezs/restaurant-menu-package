<?php

namespace Anibalealvarezs\RestaurantMenu\Database\Seeders;

use Anibalealvarezs\RestaurantMenu\Models\RmMenu;
use Anibalealvarezs\RestaurantMenu\Models\RmMenuItem;
use Illuminate\Database\Seeder;

class RmMenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default Menu Item
        RmMenuItem::create(['menu_id' => 1, 'name' => 'Dummy Dish', 'description' => 'Dummy Dish description', 'price' => 1, 'status' => 1]);
    }
}
