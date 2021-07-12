<?php

namespace Anibalealvarezs\RestaurantMenu\Database\Seeders;

use Illuminate\Database\Seeder;

class RmMainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Permissions Seeder
        $this->call([
            RmModuleSeeder::class,
            RmConfigSeeder::class,
            RmMenuSeeder::class,
            RmMenuSectionSeeder::class,
            RmMenuItemSeeder::class,
            RmPermissionsSeeder::class,
            RmTeamSeeder::class,
            RmNavigationSeeder::class,
        ]);
    }
}
