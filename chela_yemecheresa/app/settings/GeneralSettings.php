<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{

    public string $company_name;
    public string $site_title;
    public string $phone;
    public string $email;
    public string $time_zone;
    public string $language;
    public string $backend_direction;
    public string $date_format;
    public string $time_format;
    
    public static function group(): string
    {
        return 'general';
    }
}