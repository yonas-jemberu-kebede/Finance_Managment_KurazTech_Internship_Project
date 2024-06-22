<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('cache.view_cache', false);
        $this->migrator->add('cache.application_cache', false);

    }
};
