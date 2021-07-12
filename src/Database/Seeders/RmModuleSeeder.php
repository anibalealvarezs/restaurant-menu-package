<?php

namespace Anibalealvarezs\RestaurantMenu\Database\Seeders;

use Anibalealvarezs\Projectbuilder\Models\PbModule as Module;
use Illuminate\Database\Seeder;

class RmModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Module::updateOrCreate(['modulekey' => 'restmenu'], ['name' => 'Restaurant Menus', 'status' => 1]);
    }
}
