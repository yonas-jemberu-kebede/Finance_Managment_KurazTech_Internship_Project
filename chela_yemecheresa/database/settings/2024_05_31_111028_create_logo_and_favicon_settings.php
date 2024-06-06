<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

 class CreateLogoAndFaviconSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('logo.logo_path');
        $this->migrator->add('logo. favicon_path');
    }
};
