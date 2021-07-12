<?php

namespace Anibalealvarezs\RestaurantMenu\Database\Seeders;

use Anibalealvarezs\Projectbuilder\Models\PbConfig;
use Anibalealvarezs\Projectbuilder\Models\PbModule;
use Illuminate\Database\Seeder;

class RmConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $moduleConfig = PbModule::where('modulekey', 'restmenu')->first();
        // Menu Default Config
        PbConfig::updateOrCreate(['configkey' => '_MENU_DEFAULT_CURRENCY_'], ['configvalue' => 'USD', 'name' => 'Default Currency', 'description' => 'Default Currency', 'module_id' => $moduleConfig->id]);
        PbConfig::updateOrCreate(['configkey' => '_MENU_EXCHANGE_RATE_'], ['configvalue' => 3300000.00, 'name' => 'Exchange Rate', 'description' => 'Exchange Rate', 'module_id' => $moduleConfig->id]);
        PbConfig::updateOrCreate(['configkey' => '_MENU_VAT_'], ['configvalue' => 16, 'name' => 'IVA', 'description' => 'Value Added Tax (%)', 'module_id' => $moduleConfig->id]);
        PbConfig::updateOrCreate(['configkey' => '_MENU_COMMISSION_'], ['configvalue' => 10, 'name' => 'Comission', 'description' => 'Service Commission (%)', 'module_id' => $moduleConfig->id]);
    }
}
