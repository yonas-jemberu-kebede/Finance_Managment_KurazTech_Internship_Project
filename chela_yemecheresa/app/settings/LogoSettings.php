<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class LogoSettings extends Settings
{
    public ?string $logo_url;
    public ?string $favicon_url;
    public static function group(): string
    {
        return 'logo';
    }
}