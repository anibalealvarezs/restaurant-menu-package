<?php

namespace Anibalealvarezs\RestaurantMenu\Database\Seeders;

use Anibalealvarezs\Projectbuilder\Models\PbModule;
use Anibalealvarezs\Projectbuilder\Models\PbNavigation as Navigation;
use Anibalealvarezs\Projectbuilder\Models\PbPermission;
use Illuminate\Database\Seeder;

class RmNavigationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get Permissions
        $readMenuPermission = PbPermission::where('name', 'read menus')->first();
        $moduleMenu = PbModule::where('modulekey', 'restmenu')->first();

        // Parents
        $menusParent = Navigation::updateOrCreate(['name' => 'Restaurant'], ['destiny' => '#navigation-restaurant', 'type' => 'custom', 'parent' => 0, 'permission_id' => $readMenuPermission->id, 'position' => 0, 'module_id' => $moduleMenu->id]);

        // Children
        if ($menusParent) {
            Navigation::updateOrCreate(['name' => 'Menus'], ['destiny' => 'menus.index', 'type' => 'route', 'parent' => $menusParent->id, 'permission_id' => $readMenuPermission->id, 'position' => 0, 'module_id' => $moduleMenu->id]);
        }
    }
}
