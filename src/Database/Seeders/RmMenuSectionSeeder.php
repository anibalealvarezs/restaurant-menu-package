<?php

namespace Anibalealvarezs\RestaurantMenu\Database\Seeders;

use Anibalealvarezs\RestaurantMenu\Models\RmMenu;
use Anibalealvarezs\RestaurantMenu\Models\RmMenuSection;
use Illuminate\Database\Seeder;

class RmMenuSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default Menu Item
        if (RmMenuSection::count() == 0) {
            RmMenuSection::create([
                'menu_id' => RmMenu::first()->id,
                'name' => 'Dummy Section',
                'description' => 'Dummy Section description',
            ]);
        }
    }
}
