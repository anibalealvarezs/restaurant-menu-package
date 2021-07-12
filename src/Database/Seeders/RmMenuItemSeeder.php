<?php

namespace Anibalealvarezs\RestaurantMenu\Database\Seeders;

use Anibalealvarezs\RestaurantMenu\Models\RmMenu;
use Anibalealvarezs\RestaurantMenu\Models\RmMenuItem;
use Anibalealvarezs\RestaurantMenu\Models\RmMenuSection;
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
        if (RmMenuItem::count() == 0) {
            RmMenuItem::create([
                'menu_section_id' => RmMenuSection::first()->id,
                'name' => 'Dummy Dish',
                'description' => 'Dummy Dish description',
                'price' => 1,
                'status' => 1
            ]);
        }
    }
}
