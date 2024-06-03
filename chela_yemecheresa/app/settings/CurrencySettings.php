<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class CurrencySettings extends Settings
{
    public string $default_currency = 'ETB';  // ISO 4217 code for Ethiopian Birr
    public string $currency_symbol = 'Br';
    public int $decimal_places = 2;
    public string $thousand_separator = ',';
    public string $decimal_separator = '.';

    public static function group(): string
    {
        return 'currency';
    }
}