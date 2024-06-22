<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Settings\GeneralSettings;
class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = app(GeneralSettings::class);

        $settings->company_name = 'My Company';
        $settings->site_title = 'My Site';
        $settings->phone = '123-456-7890';
        $settings->email = 'info@mycompany.com';
        $settings->time_zone = 'UTC';
        $settings->language = 'en';
        $settings->backend_direction = 'ltr';
        $settings->date_format = 'Y-m-d';
        $settings->time_format = 'H:i:s';

        $settings->save();
    }
}
