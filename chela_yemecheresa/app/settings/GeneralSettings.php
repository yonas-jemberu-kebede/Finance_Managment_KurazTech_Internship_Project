<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $company_name="Hobby tech";
    public string $site_title="Cash Lite";
    public ?string $phone="+251913397265";
    public ?string $email="hobbytech19@gmail.com";
    public string $time_zone="GMT +06:00 Asia/Dhaka";
    public ?string $language="English";
    public string $backend_direction="LTR";
    public string $date_format="31/May/2024";
    public string $time_format="24 Hours";

    public static function group(): string
    {
        return 'general';
    }
}