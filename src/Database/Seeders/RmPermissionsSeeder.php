<?php

namespace Anibalealvarezs\RestaurantMenu\Database\Seeders;

use Anibalealvarezs\Projectbuilder\Models\PbModule;
use Anibalealvarezs\Projectbuilder\Models\PbRole;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RmPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $moduleMenu = PbModule::where('modulekey', 'restmenu')->first();

        // create permissions
        Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'config menus'], ['alias' => 'Configure Menus', 'module_id' => $moduleMenu->id]);
        Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'create menus'], ['alias' => 'Create Menus', 'module_id' => $moduleMenu->id]);
        Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'read menus'], ['alias' => 'Read Menus', 'module_id' => $moduleMenu->id]);
        Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'update menus'], ['alias' => 'Update Menus', 'module_id' => $moduleMenu->id]);
        Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'delete menus'], ['alias' => 'Delete Menus', 'module_id' => $moduleMenu->id]);
        Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'config menusections'], ['alias' => 'Configure Menu Sections', 'module_id' => $moduleMenu->id]);
        Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'create menusections'], ['alias' => 'Create Menu Sections', 'module_id' => $moduleMenu->id]);
        Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'read menusections'], ['alias' => 'Read Menu Sections', 'module_id' => $moduleMenu->id]);
        Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'update menusections'], ['alias' => 'Update Menu Sections', 'module_id' => $moduleMenu->id]);
        Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'delete menusections'], ['alias' => 'Delete Menu Sections', 'module_id' => $moduleMenu->id]);
        Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'config menuitems'], ['alias' => 'Configure Menu Items', 'module_id' => $moduleMenu->id]);
        Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'create menuitems'], ['alias' => 'Create Menu Items', 'module_id' => $moduleMenu->id]);
        Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'read menuitems'], ['alias' => 'Read Menu Items', 'module_id' => $moduleMenu->id]);
        Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'update menuitems'], ['alias' => 'Update Menu Items', 'module_id' => $moduleMenu->id]);
        Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'delete menuitems'], ['alias' => 'Delete Menu Items', 'module_id' => $moduleMenu->id]);
        $menuPermissions = [
            'create menus', 'read menus', 'update menus', 'delete menus', 'config menus',
            'create menuitems', 'read menuitems', 'update menuitems', 'delete menuitems', 'config menuitems',
            'create menusections', 'read menusections', 'update menusections', 'delete menusections', 'config menusections',
        ];

        // create roles and assign created permissions
        array_push($menuPermissions, 'login');
        Role::updateOrCreate(['guard_name' => 'admin', 'name' => 'menueditor'], ['alias' => 'Menu Editor'])
            ->givePermissionTo($menuPermissions);

        // assign privileges to default Project Builder roles
        // Super Admin
        $superAdminRole = PbRole::where('name', 'super-admin')->first();
        if ($superAdminRole) {
            $superAdminRole->givePermissionTo($menuPermissions);
        }
        // Admin
        $adminRole = PbRole::where('name', 'admin')->first();
        if ($adminRole) {
            $superAdminRole->givePermissionTo($menuPermissions);
        }
    }
}
