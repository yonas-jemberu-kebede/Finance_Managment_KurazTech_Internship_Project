<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('logo.logo_url', null);
        $this->migrator->add('logo.favicon_url', null);
    }
};
