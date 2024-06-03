<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class CacheSettings extends Settings
{
    public string $default_cache_store = 'file'; 
    public int $cache_lifetime = 60;             
    public bool $cache_enabled = true;           
    public bool $view_cache_enabled = true;     
    public int $view_cache_lifetime = 60;      

    public static function group(): string
    {
        return 'cache';
    }
}