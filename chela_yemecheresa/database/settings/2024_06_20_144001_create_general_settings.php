<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.company_name', 'Default Company');
        $this->migrator->add('general.site_title', 'Default Site Title');
        $this->migrator->add('general.phone', '123-456-7890');
        $this->migrator->add('general.email', 'info@company.com');
        $this->migrator->add('general.time_zone', 'UTC');
        $this->migrator->add('general.language', 'en');
        $this->migrator->add('general.backend_direction', 'ltr');
        $this->migrator->add('general.date_format', 'Y-m-d');
        $this->migrator->add('general.time_format', 'H:i:s');
    }
};
