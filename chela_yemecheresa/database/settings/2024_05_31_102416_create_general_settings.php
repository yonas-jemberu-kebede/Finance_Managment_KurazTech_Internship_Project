<?php
use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateGeneralSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.company_name', 'Hobby tech');
        $this->migrator->add('general.site_title', 'Cash Lite');
        $this->migrator->add('general.phone', '+251913397265');
        $this->migrator->add('general.email', 'hobbytech19@gmail.com');
        $this->migrator->add('general.time_zone', 'GMT +06:00 Asia/Dhaka');
        $this->migrator->add('general.language', 'English');
        $this->migrator->add('general.backend_direction', 'LTR');
        $this->migrator->add('general.date_format', '31/May/2024');
        $this->migrator->add('general.time_format', '24 Hours');
    }
}

