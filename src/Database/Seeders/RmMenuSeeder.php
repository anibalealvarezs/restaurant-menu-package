<?php

namespace Anibalealvarezs\RestaurantMenu\Database\Seeders;

use Anibalealvarezs\RestaurantMenu\Models\RmMenu;
use Illuminate\Database\Seeder;

class RmMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default Menu
        RmMenu::create(['name' => 'Dummy Menu']);
    }
}
