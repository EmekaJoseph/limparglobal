<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Seed the single site-settings row with the current real contact details.
     * Phone is left blank until the admin adds one via the Settings screen.
     */
    public function run(): void
    {
        $settings = SiteSetting::current();
        $settings->fill([
            'email' => 'limparglobal@gmail.com',
            'phone' => null,
            'linkedin' => 'https://www.linkedin.com/company/limpar-global/',
        ])->save();
    }
}
