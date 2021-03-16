<?php

namespace Anibalealvarezs\RestaurantMenu\Database\Seeders;

use Anibalealvarezs\Projectbuilder\Models\PbConfig;
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
        // Menu Default Config
        PbConfig::create(['key' => '_MENU_DEFAULT_CURRENCY_', 'value' => 'USD']);
        PbConfig::create(['key' => '_MENU_EXCHANGE_RATE_', 'value' => 1830000.00]);
    }
}
