<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class CurrencySettings extends Settings
{
    public string $currency_position;
    public string $thousand_separator;
    public string $decimal_separator;
    public int $decimal_places;
    
    public static function group(): string
    {
        return 'currency';
    }
}