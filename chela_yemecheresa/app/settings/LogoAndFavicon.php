<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class LogoAndFavicon extends Settings
{
    public string $logo_path;
    public string $favicon_path;

    public static function group(): string
    {
        return 'logo';
    }}