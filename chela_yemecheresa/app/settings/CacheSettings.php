<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class CacheSettings extends Settings
{
    public bool $view_cache;
    public bool $application_cache;
    
    public static function group(): string
    {
        return 'cache';
    }
}